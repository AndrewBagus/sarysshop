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
            ->select('id, nama, image, kategori, eta_awal, eta_akhir')
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
