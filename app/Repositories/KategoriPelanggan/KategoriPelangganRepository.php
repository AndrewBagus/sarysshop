<?php

namespace App\Repositories\KategoriPelanggan;

use App\Models\KategoriPelangganModel;

class KategoriPelangganRepository implements IKategoriPelangganRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new KategoriPelangganModel();
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
