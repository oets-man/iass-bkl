<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
	protected $userModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->session = session();
	}

	public function manage($id = null)
	{
		if (is_null($id)) {
			$data = [
				'title' => 'Pengaturan User',
				'users' => $this->userModel->get()
			];
			return view('user\data_all', $data);
		} else {
			$data = [
				'title' => 'Atur User ' . $id,
				'users' => $this->userModel->where('akun', $id)->get()
			];
			return view('user\data_one', $data);
		}
	}
	public function profile($param)
	{

		echo "<h2>Selamat Datang $param</h2>";
		echo "<h4>Halaman ini masih dalam pengembangan</h4>";
		// echo '<br><br><br>';
		// var_dump($this->userModel->where('akun', 'oets@gmail.com')->get());
	}
	public function activate($akun)
	{
		$userAuth = new \App\Models\AuthModel();
		$userAuth->userActivate($akun);
		return redirect()->to("user/manage/$akun");
	}
}
