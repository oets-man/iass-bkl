<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\IncomingRequest;

use App\Models\ServerSideModel;
use Config\Services;

/**
 * @property IncomingRequest $request;
 */



class Anggota extends BaseController
{
	public function index()
	{
		if (session('role_level') != 1) {
			redirect()->back();
			exit;
		}
		// $anggotaModel = new \App\Models\AnggotaModel();
		// $anggota = $anggotaModel->getAnggota();

		// $authModel = new \App\Models\AuthModel();
		// $komisariat = $authModel->komisariatGet();

		// $alamatModel	= new \App\Models\AlamatModel();
		// $idKab = '3526';
		$data = [
			'title'			=> 'Daftar Anggota',
			// 'anggota'		=> $anggota->getResult(),
			// 'kecamatan'		=> $alamatModel->getKecamatan($idKab),
			// 'komisariat'	=> $komisariat->getResult()
		];
		return view('anggota/anggotaIndex', $data);
	}

	public function komisariat($komisariat = null)
	{
		if (is_null($komisariat)) {
			echo "Tentukan Komisariat di url";
			exit;
		}
		$data = [
			'title'			=> 'Daftar Anggota',
			'komisariat'	=> $komisariat
		];
		return view('anggota/anggotaIndex', $data);
	}

	public function anggotaInsert()
	{

		$authModel = new \App\Models\AuthModel();
		$komisariat = $authModel->komisariatGet();

		$alamatModel	= new \App\Models\AlamatModel();
		$idKab = '3526';
		$data = [
			'kecamatan'		=> $alamatModel->getKecamatan($idKab),
			'komisariat'	=> $komisariat->getResult()
		];
		return view('anggota/anggotaInsert', $data);
	}

	public function getAlamat()
	{
		if ($this->request->getVar('aksi')) {
			$aksi = $this->request->getVar('aksi');
			if ($aksi == 'getDesa') {
				$alamatModel	= new \App\Models\AlamatModel();
				$kec_id = $this->request->getVar('kec_id');
				$data = $alamatModel->getDesa($kec_id)->getResultArray();
				echo json_encode($data);
			}
		}
	}
	public function insert()
	{
		# code...
	}

	public function listdata($komisariat = null)
	{
		$request = Services::request();
		$datamodel = new ServerSideModel($request);
		// if ($request->getMethod(true) == 'POST') {
		if ($request->getPost()) {
			// if (!is_null($this->request->getVar('komisariat'))) {
			// 	echo json_encode(['xxx' => $this->request->getVar('komisariat')]);
			// 	exit;
			// }

			$lists = $datamodel->get_datatables();
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
				$row[] = $list->status;
				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $datamodel->count_all(),
				"recordsFiltered" => $datamodel->count_filtered(),
				"data" => $data
			];
			echo json_encode($output);
		}
	}
	function Detail($id)
	{
		echo "<h1>Dalam Pengembangan</h1>";
	}
}
