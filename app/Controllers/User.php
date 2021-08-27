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
				'users' => $this->userModel->where('email', $id)->get()
			];
			return view('user\data_one', $data);
		}
	}
	public function profile($param = null)
	{

		echo "<h1>Dalam perbaikan ~ $param</h1>";
	}
	public function activate($email)
	{
		$userAuth = new \App\Models\AuthModel();
		$userAuth->userActivate($email);
		return redirect()->to("user/manage/$email");
	}
}
