<?php

namespace App\Repositories\KategoriProduk;

use App\Models\KategoriProdukModel;

class KategoriProdukRepository implements IKategoriProdukRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new KategoriProdukModel();
  }

  public function getActive()
  {
    return $this->model->where('is_active', true);
  }

  public function getById($id)
  {
    return $this->model->where('id', $id);
  }

  public function save($data)
  {
    $this->model->save($data);
    return  $this->model->getInsertID();
  }
}
