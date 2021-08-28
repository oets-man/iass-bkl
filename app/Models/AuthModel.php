<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
	protected $db;
	protected $tabelUser;
	protected $tabelRole;
	public function __construct()
	{
		$this->db = db_connect();
		$this->tabelUser = $this->db->table('user');
		$this->tabelRole = $this->db->table('user_role');
	}

	public function roleGet($id = null)
	{
		if (is_null($id)) {
			$builder = $this->tabelRole;
		} else {
			$builder = $this->tabelRole->where('id', $id);
		}
		$query = $builder->get();
		return $query;
	}
	public function userGet($key = null)
	{
		if (is_null($key)) {
			$builder = $this->tabelUser;
		} else {
			$builder = $this->tabelUser->where('email', $key);
		}
		$query = $builder->get();
		return $query;
	}
	public function userActivate($email)
	{
		$cek = $this->tabelUser->where('email', $email)->where('is_active', 1)->countAllResults();
		if ($cek > 0) {
			return $this->tabelUser->set('is_active', 0)->where('email', $email)->update();
		} else {
			return $this->tabelUser->set('is_active', 1)->where('email', $email)->update();
		}
	}
}
