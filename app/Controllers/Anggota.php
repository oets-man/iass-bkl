<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use CodeIgniter\HTTP\IncomingRequest;

use Config\Services;

/**
 * @property IncomingRequest $request;
 */

use App\Config\Security;

class Anggota extends BaseController
{
	public function index()
	{
		if (session('role_level') != 1) {
			// session()->setFlashData('errors', ['Akses Pengurus Wilayah.']);
			$komisariat = session('komisariat');
			redirect()->to(base_url("komisariat/$komisariat"));
		}
		$data = [
			'title'			=> 'Daftar Anggota',
		];
		return view('anggota/anggotaIndex', $data);
	}

	public function komisariat($param = null)
	{
		$komisariat = session('komisariat');
		if (is_null($param)) {
			session()->setFlashData('errors', ['Tentukan Komisariat di url.']);
			return redirect()->back();
		}
		$level = session('role_level');
		$path = $_SERVER['PATH_INFO'];
		$find = stripos($path, $komisariat);
		if ($level != 1) {
			if (!$find) {
				session()->setFlashData('errors', [
					'Akses dibatasi.',
					"Tetap menampilkan komisarat $komisariat."
				]);
				return redirect()->back();
			}
		}

		$data = [
			'title'			=> "Daftar Anggota / $komisariat",
		];
		return view('anggota/anggotaIndex', $data);
	}

	public function listdata()
	{
		$request = Services::request();
		$anggotaModel = new \App\Models\AnggotaModel($request);
		if ($request->getPost()) {

			$lists = $anggotaModel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$tombol = "<a href=" . base_url('anggota/detail') . "/" . $list->id . " type=\"button\" class=\"btn btn-info btn-sm\" \"><i class=\"fas fa-info-circle\"></i></a>";
				$no++;
				$row = [];
				$row[] = $tombol;
				$row[] = $no;
				$row[] = $list->nama;
				$row[] = $list->alamat1;
				$row[] = $list->komisariat;
				$row[] = $list->ranting;
				$row[] = $list->status;
				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $anggotaModel->count_all(),
				"recordsFiltered" => $anggotaModel->count_filtered(),
				"data" => $data
			];
			$output[csrf_token()] = csrf_hash();
			echo json_encode($output);
		}
	}
	public function modalInsert()
	{

		// $authModel = new \App\Models\AuthModel();
		// $komisariat = $authModel->komisariatGet();

		// $alamatModel	= new \App\Models\AlamatModel();
		// $idKab = '3526';
		// $data = [
		// 	'kecamatan'		=> $alamatModel->getKecamatan($idKab),
		// 	'komisariat'	=> $komisariat->getResult()
		// ];
		// return view('anggota/anggotaInsert', $data);
	}

	public function getAlamat()
	{
		if ($this->request->getVar('aksi')) {
			$aksi = $this->request->getVar('aksi');
			if ($aksi == 'getDesa') {
				$alamatModel	= new \App\Models\AlamatModel();
				$kec_id = $this->request->getVar('kec_id');
				$data = $alamatModel->getDesa($kec_id)->getResultArray();
				$result = [
					'csrf_token' => csrf_hash(), //kirim token baru
					'list' => $data
				];
				return json_encode($result);
			}
		}
	}

	// private function emptyToNull($array)
	// {
	// 	return array_map(function ($v) {
	// 		return ($v === '') ? NULL : $v;
	// 	}, $array);
	// }

	public function insert()
	{
		if (!session('getKomisariat')) {
			session()->setFlashData('errors', ['Session Komisariat tidak ditemukan.', 'Silakan Akses melalui menu Komisariat!']);

			return redirect()->back();
		}

		if ($this->request->getPost()) {
			$validation = \Config\Services::validation();
			$session = session();
			$data = $this->request->getPost();
			$validation->run($data, 'anggota');
			$errors = $validation->getErrors();
			// $ins = $this->emptyToNull($data);

			// $ins = array_filter($data, function ($value) {
			// 	return !is_null($value) && $value !== '';
			// });
			// $ins = array_filter($data);
			// dd($ins);

			if (!$errors) {
				$anggotaEntity = new \App\Entities\AnggotaEntity();
				$anggotaModel = new \App\Models\AnggotaModel();

				$data = array_filter($data);
				$anggotaEntity->fill($data);

				$insert = $anggotaModel->insert($anggotaEntity);
				if ($insert) {
					$session->setFlashdata('success', 'Tambah data anggota berhasil.');
					return redirect()->back();
				} else {
					$session->setFlashData('errors', [
						'Data gagal ditambahkan.',
						'Cek ulang data Anda.',
						'Catatan: beberapa data harus unik seperti NIK, ID IASS, dan ID PPS.'
					]);
					return redirect()->back()->withInput();
				}
			}
			$session->setFlashdata('errors', $errors);
			return redirect()->back()->withInput();
		} else {
			$alamatModel	= new \App\Models\AlamatModel();
			$idKab = '3526';

			$pps_kelas = $this->db->query("SELECT * FROM list_kelas")->getResult();
			$pps_tingkat = $this->db->query("SELECT * FROM list_tingkat_pps")->getResult();
			$formal_tingkat = $this->db->query("SELECT * FROM list_tingkat_formal")->getResult();
			$ranting = $this->db->table('list_ranting')->where('komisariat', session('urlKomisariat'))->get()->getResult();

			$data = [
				'kecamatan'			=> $alamatModel->getKecamatan($idKab)->getResult(),
				'kab_kota'			=> $alamatModel->getKabKota()->getResult(),
				'pps_kelas'			=> $pps_kelas,
				'pps_tingkat' 		=> $pps_tingkat,
				'formal_tingkat' 	=> $formal_tingkat,
				'title'				=> 'Tambah Anggota',
				'ranting'			=> $ranting
			];
			return view('anggota/anggotaInsert', $data);
		}
	}


	function Detail($id)
	{
		$anggotaModel = new \App\Models\AnggotaModel();
		$anggota = $anggotaModel->getAnggota($id)->getRow();
		$data = [
			'title'			=> 'Detail Anggota',
			'anggota'		=> $anggota,
		];

		return view('anggota/anggotaDetail', $data);
	}
}
