<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'anggota';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\AnggotaEntity';
	protected $useSoftDeletes       = false;
	protected $protectFields        = false;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	protected $db;
	protected $viewAnggota;
	public function __construct()
	{
		$this->db = db_connect();
		$this->viewAnggota = $this->db->table('anggota_view');
	}
	public function getAnggota()
	{
		$builder = $this->viewAnggota;
		$query = $builder->get();
		return $query;
	}
}
