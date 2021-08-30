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
		// ->join('list_kecamatan', 'anggota.kec_id=list_kecamatan.id')
		// ->get();

		$alamatModel	= new \App\Models\AlamatModel();
		$idKab = '3526';
		$data = [
			'title'		=> 'Daftar Anggota',
			'anggota'	=> $anggota,
			'kecamatan'	=> $alamatModel->getKecamatan($idKab)
		];
		return view('anggota/data_all', $data);
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
