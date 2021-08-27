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
	public $login = [
		'email' => [
			'rules' => 'required',
			'label' => 'Email'
		],
		'password' => [
			'rules' => 'required',
			'label' => 'Password'
		],
	];
	public $reset = [
		'email' => [
			'rules' => 'required',
			'label' => 'Email'
		],
		'password' => [
			'rules' => 'required',
			'label' => 'Password'
		],
		'passwordN' => [
			'rules' => 'required|min_length[3]',
			'label' => 'Password baru'
		],
		'passwordR' => [
			'rules' => 'required|matches[passwordN]',
			'label' => 'Konfirmasi password'
		],
	];
	public $registrasi = [
		'email' => [
			'rules' => 'required|valid_email|is_unique[user.email]',
		],
		'nama' => [
			'rules' => 'required|min_length[3]',
		],
		'password' => [
			'rules' => 'required|min_length[3]',
		],
		'passwordR' => [
			'rules' => 'required|matches[password]',
			'label' => 'Konfirmasi password'
		],
		'jabatan' => [
			'rules' => 'required'
		],
		'role_id' => [
			'rules' => 'required'
		],

	];
}
