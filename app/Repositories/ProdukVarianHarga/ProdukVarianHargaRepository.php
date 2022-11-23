<?php

namespace App\Repositories\ProdukVarianHarga;

use App\Models\ProdukVarianHargaModel;

class ProdukVarianHargaRepository implements IProdukVarianHargaRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new ProdukVarianHargaModel();
  }

  public function getByProduk($produk_id)
  {
    return $this->model->where([
      'produk_id' => $produk_id,
      'is_active' => true
    ]);
  }

  public function getById($id)
  {
    return $this->model->where('id', $id);
  }

  public function getByVarian($varian_id)
  {
    return $this->model->where([
      'produk_varian_id' => $varian_id,
      'is_active' => true
    ]);
  }

  public function getByVarianKategoriPelanggan($varian_id, $kategori_pelanggan_id)
  {
    return $this->model->where([
      'produk_varian_id' => $varian_id,
      'kategori_pelanggan_id' => $kategori_pelanggan_id,
      'is_active' => true
    ]);
  }

  public function save($data)
  {
    return $this->model->save($data);
  }
}
