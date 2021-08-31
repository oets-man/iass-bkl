<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
	protected $db;
	protected $tabelProv;
	protected $tabelKab;
	protected $tabelKec;
	protected $tabelDesa;

	public function __construct()
	{
		$this->db = db_connect();
		$this->tabelProv	= $this->db->table('list_provinsi');
		$this->tabelKab 	= $this->db->table('list_kabupaten');
		$this->tabelKec 	= $this->db->table('list_kecamatan');
		$this->tabelDesa 	= $this->db->table('list_desa');
	}
	public function getKecamatan($id)
	{
		$builder = $this->tabelKec->where('kab_id', $id)->orderBy('kecamatan');
		$query	 = $builder->get();
		return $query;
	}

	public function getDesa($id)
	{
		$builder = $this->tabelDesa->where('kec_id', $id)->orderBy('desa');
		$query	 = $builder->get();
		return $query;
	}
}
