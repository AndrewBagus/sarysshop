<?php

namespace App\Repositories\ProdukVarian;

use App\Models\ProdukVarianModel;

class ProdukVarianRepository implements IProdukVarianRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new ProdukVarianModel();
  }

  public function getByProduk($produk_id)
  {
    return $this->model->where([
      'produk_id' => $produk_id,
      'is_active' => true
    ]);
  }

  public function checkCode($id, $code)
  {
    return $this->model->where([
      'id !=' => $id,
      'code' => $code
    ]);
  }

  public function getById($id)
  {
    return $this->model->where('id', $id);
  }

  public function save($data)
  {
    $this->model->save($data);
    return $this->model->getInsertID();
  }
}
