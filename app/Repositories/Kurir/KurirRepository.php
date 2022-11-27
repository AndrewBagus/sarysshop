<?php

namespace App\Repositories\Kurir;

use App\Models\KurirModel;

class KurirRepository implements IKurirRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new KurirModel();
    }

    private function getKurir()
    {
        return $this->model
            ->select('id, nama, image, (select count(p.id) from m_pengiriman p where p.kurir_id = m_kurir.id and p.is_active = true) as layanan')
            ->where('is_active', true);
    }

    public function getActive()
    {
        return $this->getKurir();
    }

    public function getById($id)
    {
        return $this->getKurir->where('id', $id);
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }
}
