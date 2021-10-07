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

	public function registrasi()
	{
		$this->isLoggedIn();

		if ($this->request->getPost()) {
			$data = $this->request->getPost();
			$this->validation->run($data, 'registrasi');
			$errors = $this->validation->getErrors();

			if (!$errors) {
				$userEntity = new \App\Entities\UserEntity();
				$userModel = new \App\Models\UserModel();

				$userEntity->fill($data);
				$userModel->insert($userEntity);
				$this->session->setFlashdata('success', 'Registrasi Berhasil! Silakan Login');
				return redirect()->to(base_url('auth/login'));
			}

			$this->session->setFlashdata('errors', $errors);
		}
		//kirim list role
		$authModel = new \App\Models\AuthModel();
		$data = [
			'role' => $authModel->roleGet(),
			'title' => 'Registrasi'
		];
		return view('auth/registrasi', $data);
	}

	private function isLoggedIn()
	{
		if (session()->has('isLoggedIn')) {
			$this->session->setFlashData('errors', [
				'Anda sudah masuk. Silakan <a href="logout">keluar</a> terlebih dahulu untuk mengakses halaman ini.',
				'Atau Anda bisa kembali ke halaman <a href="javascript:history.back()">sebelumnya</a>.'
			]);
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
				$email = $this->request->getPost('email');
				$password = $this->request->getPost('password');

				$userModel = new \App\Models\UserModel();
				$user = $userModel->where('email', $email)->first();

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
									'user_email' 	=> $user->email,		//parameter authFilter
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
									'title' => 'Reset Password',
									'email' => $email
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
		];
		return view('auth/login', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url('auth/login'));
	}

	public function reset($email = null)
	{
		if ($this->request->getPost()) {
			$data = $this->request->getPost();
			$this->validation->run($data, 'reset');
			$errors = $this->validation->getErrors();

			// cek validasi
			if (!$errors) {
				$email = $this->request->getPost('email');
				$userModel = new \App\Models\UserModel();
				$user = $userModel->where('email', $email)->first();
				//cek user
				if ($user) {
					//cek password
					$password = $this->request->getPost('password');
					$passwordN = $this->request->getPost('passwordN');
					$passwordHash = password_hash($passwordN, PASSWORD_BCRYPT);

					if ((password_verify($password, $user->password))) {
						//lakukan update
						$userModel
							->set('password', $passwordHash)
							->set('is_reset', 0)
							->where('email', $email)
							->update();
						$this->session->setFlashData('success', 'Ganti kata sandi berhasil. Silakan login.');
						$this->logout();
						return view('auth/login', ['title' => 'Login']);
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
		$data = [
			'title' => 'Ganti Password',
			'email' => $email
		];
		return view('auth/reset', $data);
	}
}
