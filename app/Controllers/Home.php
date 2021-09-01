<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$db = \Config\Database::connect();
		$komisariat = $db->query("SELECT DISTINCT komisariat as komisariat FROM anggota")->getResult();

		$data = [
			'title' => 'Dashboard',
			'komisariat' => $komisariat
		];
		return view('index', $data);
	}
}
