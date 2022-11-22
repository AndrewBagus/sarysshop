<?php

namespace App\Repositories\JenisProduk;

use App\Models\JenisProdukModel;

class JenisProdukRepository implements IJenisProdukRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new JenisProdukModel();
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
    return $this->model->save($data);
  }
}
