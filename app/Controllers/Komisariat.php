<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Komisariat extends BaseController
{
    public function index()
    {
        //
    }
    public function ranting($komisariat)
    {

        $ranting = $this->db->table('list_ranting')->where('komisariat', $komisariat)->get()->getResult();
        // $ranting = $db->table('list_ranting')->get()->getResult();
        // $komisariat = $db->table('user_role')->get()->getResult();
        $data = [
            'ranting' => $ranting,
            'komisariat' => $komisariat,
        ];

        return view('komisariat/ranting', $data);
    }
    public function delRanting()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $this->db->table('list_ranting')->where('id', $id)->delete();
            return json_encode(true);
        }
        return json_encode(false);
    }

    public function insertRanting()
    {
        if ($this->request->isAJAX()) {
            // $data = $this->request->getPost();
            $countIns = 0;
            $komisariat = $this->request->getPost('komisariat');
            $ranting = $this->request->getPost('ranting');
            for ($i = 0; $i < count($ranting); $i++) {
                if (trim($komisariat[$i]) != '' && trim($ranting[$i]) != '') {
                    $this->db->table('list_ranting')->insert([
                        'komisariat' => trim($komisariat[$i]),
                        'ranting' => trim($ranting[$i])
                    ]);
                    if ($this->db->affectedRows() > 0) {
                        $countIns++;
                    }
                }
            }
            $respon = true;
        } else {
            $respon = false;
        }

        if ($countIns < 1) {
            $respon = false;
        }
        return json_encode($respon);
    }
}
