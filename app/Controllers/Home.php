<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$komisariat = $db->query("SELECT DISTINCT komisariat as komisariat FROM anggota")->getResult();
		$komisariatCount = $db->query("SELECT Count(anggota_view.id) AS subTotal, anggota_view.status
		 		FROM anggota_view 
				GROUP BY anggota_view.status")->getResult();

		$data = [
			'title' => 'Dashboard',
			'komisariat' => $komisariat,
			'komisariatCount' => $komisariatCount
		];
		return view('index', $data);
	}

	public function voler()
	{
		return view('layout/voler');
	}
	public function voler_auth()
	{
		return view('layout/voler_auth');
	}
}
