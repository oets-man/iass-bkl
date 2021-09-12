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
	// protected $useTimestamps        = false;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at';
	// protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];

	protected $viewAnggota = "anggota_view";
	protected $column_order = array(null, null,  'nama', 'alamat1', 'komisariat', 'status'); //urut sesuai dengan kolom pada view jumlah sesuai dengan <th></th>
	protected $column_search = array('nama', 'alamat1', 'komisariat', 'status');
	protected $dt;


	public function __construct()
	{
		parent::__construct();
	}
	// public function getAnggota()
	// {
	// 	$builder = $this->viewAnggota;
	// 	$query = $builder->get();
	// 	return $query;
	// }



	private function _filterQuery()
	{
		//session dibuat di controller/auth
		$level 			= session('role_level');
		$komisariat 	= session('komisariat');

		//session dibuat di view/anggotaindex
		$getKomisariat 	= session('getKomisariat');
		$urlKomisariat 	= session('urlKomisariat');

		// $this->dt = $this->db->table($this->viewAnggota)->select('id', 'nama', 'alamat1', 'komisariat', 'id_status', 'status');

		if ($level == 1) {
			if ($getKomisariat == true) {
				$this->dt = $this->db->table($this->viewAnggota)->where('komisariat', $urlKomisariat);
				// $this->dt->where('komisarat', $urlKomisariat);
			} else {
				$this->dt = $this->db->table($this->viewAnggota);
			}
		} elseif ($level == 2) {
			$this->dt = $this->db->table($this->viewAnggota)->where('komisariat', $komisariat);
		}
		// session()->remove('getKomisariat');
		// session()->remove('urlKomisariat');

		return $this;
	}

	private function _get_datatables_query()
	{
		$this->_filterQuery();
		$i = 0;
		foreach ($this->column_search as $item) { // loop column 
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) {
					$this->dt->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->dt->like($item, $_POST['search']['value']);
				} else {
					$this->dt->orLike($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->dt->groupEnd(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) { // here order processing
			$this->dt->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			// } else if (isset($this->order)) {
			// 	$order = $this->order;
			// 	$this->dt->orderBy(key($order), $order[key($order)]);
		} else {
			$this->dt
				->orderBy('komisariat', 'asc')
				->orderBy('id_status', 'asc')
				->orderBy('id', 'desc');
		}
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != -1)
			$this->dt->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->dt->get();
		return $query->getResult();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		return $this->dt->countAllResults();
	}

	public function count_all()
	{
		$tbl_storage = $this->_filterQuery();
		// $tbl_storage = $this->db->table($this->viewAnggota);
		return $tbl_storage->countAllResults();
	}
}
