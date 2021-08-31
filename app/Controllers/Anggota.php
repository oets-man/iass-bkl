<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request;
 */



class Anggota extends BaseController
{
	public function index()
	{
		$anggotaModel = new \App\Models\AnggotaModel();
		$anggota = $anggotaModel->getAnggota();

		$authModel = new \App\Models\AuthModel();
		$komisariat = $authModel->komisariatGet();

		$alamatModel	= new \App\Models\AlamatModel();
		$idKab = '3526';
		$data = [
			'title'			=> 'Daftar Anggota',
			'anggota'		=> $anggota->getResult(),
			'kecamatan'		=> $alamatModel->getKecamatan($idKab),
			'komisariat'	=> $komisariat->getResult()
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
}
