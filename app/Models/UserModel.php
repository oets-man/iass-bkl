<?php

namespace App\Models;

use CodeIgniter\Model;
// use CodeIgniter\Database\BaseBuilder; belum dibutuhkan untuk subquery

class UserModel extends Model
{
	protected $db;
	protected $tabelUser;
	protected $tabelRole;
	protected $returnType 			= 'App\Entities\UserEntity';
	protected $table                = 'user';
	protected $primaryKey           = 'email';
	protected $protectFields        = true;
	protected $allowedFields        = ['email', 'nama', 'password', 'avatar', 'jabatan', 'role_id', 'is_active', 'is_reset'];
}