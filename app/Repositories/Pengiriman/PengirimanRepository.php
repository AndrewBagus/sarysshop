<?php

namespace App\Repositories\Pengiriman;

use App\Models\PengirimanModel;

class PengirimanRepository implements IPengirimanRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new PengirimanModel();
    }

    private function getPengiriman()
    {
        $table = 'm_pengiriman';
        return $this->model
            ->join('m_kurir as k', $table . '.kurir_id = k.id')
            ->select($table . '.id, ' . $table . '.nama, k.nama as kurir, k.image')
            ->where($table . '.is_active', true);
    }

    public function getActive()
    {
        return $this->getPengiriman();
    }

    public function getById($id)
    {
        return $this->getPengiriman()
            ->where('m_pengiriman.id', $id)
            ->get()
            ->getRow();
    }

    public function getByKurir($kurir_id)
    {
        return $this->getPengiriman()
            ->where('m_pengiriman.kurir_id', $kurir_id)
            ->get()
            ->getResult();
    }

    public function findByKurir($nama)
    {
        return $this->getPengiriman()
            ->like('m_pengiriman.kurir_id', 'like', $nama)
            ->get()
            ->getResult();
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }

    public function removeByKurir($kurir_id)
    {
        return $this->model
            ->where('kurir_id', $kurir_id)
            ->set('is_active', false)
            ->update();
    }
}
