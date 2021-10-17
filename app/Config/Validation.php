<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		\App\Validation\MyRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	// app\Validation\MyRules.php
	public $login = [
		'akun' => [
			'rules' => 'required',
			'label' => 'Akun atau Username'
		],
		'password' => [
			'rules' => 'required',
			'label' => 'Password'
		],
	];
	public $reset = [
		'akun' => [
			'rules' => 'required',
			'label' => 'Akun'
		],
		'passwordO' => [
			'rules' => 'required',
			'label' => 'Password lama'
		],
		'password' => [
			'rules' => 'required|min_length[6]',
			'label' => 'Password baru'
		],
		'passwordR' => [
			'rules' => 'required|matches[password]',
			'label' => 'Konfirmasi password'
		],
	];
	public $registrasi = [
		// 'email' => [
		// 	'rules' => 'required|valid_email|is_unique[user.email]',
		// ],
		'akun' => [
			'rules' => 'trim|required|is_unique[user.akun]|min_length[5]|alpha_dash',
			'label' => 'Akun'
		],
		'nama' => [
			'rules' => 'trim|required|min_length[5]|valid_name',
			'label' => 'Nama',
			'errors' => ['valid_name' => 'Terdapat karakter yang tidak didukung pada input {field}.']
		],
		'password' => [
			'rules' => 'required|min_length[6]',
		],
		'passwordR' => [
			'rules' => 'required|matches[password]',
			'label' => 'Konfirmasi password'
		],
		'jabatan' => [
			'rules' => 'trim|required'
		],
		'role_id' => [
			'rules' => 'required'
		],
	];
	public $anggota = [
		'nama' => [
			'rules' => 'required|min_length[5]|valid_name',
			'label' => 'Nama',
			'errors' => [
				'valid_name' => 'Terdapat karakter yang tidak didukung pada input {field}.',
			]
		],
		'komisariat' => [
			'rules' => 'required',
			'label' => 'Komisariat'
		],
		'id_iass'	=> [
			'rules'	=> 'is_unique[anggota.id_iass]',
			'label'	=> 'ID IASS'
		],
		'nik'	=> [
			// 'rules'	=> 'is_unique[anggota.nik]|max_length[16]|min_length[16]',
			// 'rules'	=> 'is_unique[anggota.nik]|exact_length[16]',
			'rules'	=> 'is_unique[anggota.nik]|valid_NIK',
			'label'	=> 'NIK',
			'errors' => [
				'valid_NIK' => 'Hanya menerima angka dan harus 16 karakter.'
			]
		],
		'pps_id'	=> [
			'rules'	=> 'is_unique[anggota.pps_id]',
			'label'	=> 'ID PPS'
		],
	];
}
