<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
	protected $attributes = [
		'passwordR' => null,
	];
	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];
	public function setPassword(string $pass) // harus sama dengan field db awali dengan set
	{
		$this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
		return $this;
	}
	public function setAvatar($file)
	{
		$fileName = $file->getRandomName();
		$writePath = './uploads/img';
		$file->move($writePath, $fileName);
		$this->attributes['avatar'] = $fileName;
		return $this;
	}
}
