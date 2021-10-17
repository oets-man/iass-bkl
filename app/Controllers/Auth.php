<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function __construct()
	{
		// helper('form');
		$this->validation = \Config\Services::validation();
		$this->session = session();
	}

	function phpAlert($msg)
	{
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

	public function registrasi()
	{
		$this->isLoggedIn(); //redirect tak jalan

		if ($this->request->getPost()) {

			$data = $this->request->getPost();
			$this->validation->run($data, 'registrasi');
			$errors = $this->validation->getErrors();

			if (!$errors) {
				$userEntity = new \App\Entities\UserEntity();
				$userModel = new \App\Models\UserModel();
				$data = array_filter($data);
				$userEntity->fill($data);

				$insert = $userModel->insert($userEntity);
				if ($insert) {
					$this->session->setFlashdata('success', 'Registrasi berhasil. Silakan hubungi Ust Tijani Fattah untuk aktivasi!');
					return redirect()->to(base_url('auth/login'));
				} else { // tak jalan. PR
					$this->session->setFlashData('errors', ['Registrasi gagal. Cek ulang data Anda.']);
					redirect()->back()->withInput();
				}
			}

			$this->session->setFlashdata('errors', $errors);
			redirect()->back()->withInput();
		}
		//kirim list role
		$authModel = new \App\Models\AuthModel();
		$data = [
			'role' => $authModel->roleGet(),
			'title' => 'Registrasi',
			'heading'	=> 'Daftar',
			'caption' => 'Silakan isi form berikut untuk mendaftar',
		];
		return view('auth/registrasi', $data);
	}

	private function isLoggedIn()
	{
		if (session()->has('isLoggedIn')) {
			$this->session->setFlashData('errors', [
				'Anda sudah masuk. Silakan <a href="logout">keluar</a> terlebih dahulu untuk mengakses halaman ini.',
				'Atau Anda bisa kembali ke halaman <a href="javascript:history.back()">sebelumnya</a> atau menuju ke <a href="' . site_url()  . '">Beranda</a>.'
			]);
			// return true;
			return redirect()->back();
		}
	}

	public function login()
	{
		$this->isLoggedIn();

		if ($this->request->getPost()) {

			$data = $this->request->getPost();
			$this->validation->run($data, 'login');
			$errors = $this->validation->getErrors();

			if (!$errors) {
				$akun = $this->request->getPost('akun');
				$password = $this->request->getPost('password');

				$userModel = new \App\Models\UserModel();
				$user = $userModel->where('akun', $akun)->first();

				if ($user) {
					//cek password
					if ((password_verify($password, $user->password))) {
						//cek aktif
						if ($user->is_active == 1) {
							//cek reset
							if ($user->is_reset != 1) {
								//berhasil login
								$authModel = new \App\Models\AuthModel();
								$role = $authModel->roleGet($user->role_id)->getRow();
								$sessData = [
									'user_akun' 	=> $user->akun,		//parameter authFilter
									'user_nama' 	=> $user->nama,
									'user_jabatan' 	=> $user->jabatan,
									'user_avatar' 	=> $user->avatar,
									'role_id' 		=> $role->id,			//parameter authFilter
									'role_level' 	=> $role->level,
									'isLoggedIn' 	=> TRUE,				//parameter authFilter
									'komisariat'	=> $role->id,
								];
								$this->session->set($sessData);
								$this->session->setFlashData('success', 'Masuk sebagai ' . $user->nama);
								return redirect()->to(base_url('home/index'));
							} else { // harus reset
								$this->session->setFlashData('errors', ['Kata sandi perlu diperbaharui.']);
								$data = [
									'title' 	=> 'Reset Password',
									'akun' 		=> $akun,
									'heading'	=> 'Ganti Password',
									'caption' 	=> 'Isikan password lama dan baru.',
								];
								return view('auth/reset', $data);
							}
						} else {
							$this->session->setFlashData('errors', ['Akun belum aktif. Silakan hubungi Ust Tijani Fattah.']);
						}
					} else {
						$this->session->setFlashData('errors', ['Kata sandi salah.']);
					}
				} else {
					$this->session->setFlashData('errors', ['User tidak ditemukan.']);
				}
			} else {
				$this->session->setFlashData('errors', $errors);
			}
		}
		$data = [
			'title' => 'Login',
			'heading'	=> 'Login',
			'caption' => 'Silakan masukkan akun dan password!',
		];
		return view('auth/login', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url('auth/login'));
	}

	public function reset($akun = null)
	{
		$dataview = [
			'title' => 'Ganti Password',
			'akun' => $akun ?: "",
			'heading'	=> 'Ganti Password',
			'caption' => 'Isikan password lama dan baru.',
		];


		if ($this->request->getPost()) {
			$data = $this->request->getPost();
			$this->validation->run($data, 'reset');
			$errors = $this->validation->getErrors();

			// cek validasi
			if (!$errors) {
				$akun = $this->request->getPost('akun');
				$userModel = new \App\Models\UserModel();
				$user = $userModel->where('akun', $akun)->first();
				//cek user
				if ($user) {
					//cek password
					$passwordO = $this->request->getPost('passwordO');
					$password = $this->request->getPost('password');

					if ((password_verify($passwordO, $user->password))) {
						//lakukan update
						$userEntity = new \App\Entities\UserEntity();
						$userEntity->password = $password;
						$userModel
							->set('password', $userEntity->password)
							->set('is_reset', 0)
							->where('akun', $akun)
							->update();

						$this->session->setFlashData('success', 'Ganti kata sandi berhasil. Silakan login.');
						$this->logout();
						return view('auth/login', $dataview);
					} else {
						//password salah
						$this->session->setFlashData('errors', ['Kata sandi salah.']);
					}
				} else {
					//user tidak ditemukan
					$this->session->setFlashData('errors', ['User tidak ditemukan.']);
				}
			} else {
				//error validasi
				$this->session->setFlashdata('errors', $errors);
			}
		}

		return view('auth/reset', $dataview);
	}
}
