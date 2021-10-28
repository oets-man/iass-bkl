<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modal extends BaseController
{

    public function status($id_anggota)
    {
        $status = $this->db->table('status_view')->where('id_anggota', $id_anggota)->orderBy('id', 'asc')->get()->getResult();
        $list_status = $this->db->table('list_status')->get()->getResult();
        $anggota = $this->db->table('anggota')->where('id', $id_anggota)->get()->getRow();
        $data = [
            'status' => $status,
            'anggota' => $anggota,
            'list_status' => $list_status,
        ];
        return view('modal/status', $data);
    }

    public function insertStatus()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            $this->db->table('status')->insert($data);
            $respon = true;
        } else {
            $respon = false;
        }
        return json_encode($respon);
    }

    public function delStatus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->db->table('status')->where('id', $id)->delete();
            return json_encode(true);
        }
        return json_encode(false);
    }

    public function ranting($komisariat)
    {
        $ranting = $this->db->table('list_ranting')->where('komisariat', $komisariat)->get()->getResult();
        $data = [
            'ranting' => $ranting,
            'komisariat' => $komisariat,
        ];
        return view('modal/ranting', $data);
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
