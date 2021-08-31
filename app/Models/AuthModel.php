<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
	protected $db;
	protected $tabelUser;
	protected $viewRole;
	public function __construct()
	{
		$this->db = db_connect();
		$this->tabelUser = $this->db->table('user');
		$this->viewRole = $this->db->table('user_role_view');
	}

	public function roleGet($id = null)
	{
		if (is_null($id)) {
			$builder = $this->viewRole;
		} else {
			$builder = $this->viewRole->where('id', $id);
		}
		$query = $builder->get();
		return $query;
	}
	public function komisariatGet()
	{
		$builder = $this->viewRole->where('level', 2)->orderBy('id');
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
