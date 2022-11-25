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

  public function getInVarians($varians)
  {
    $table = 'm_produk_varian_harga';
    return $this->model
      ->join('m_kategori_pelanggan kp', $table . '.kategori_pelanggan_id = kp.id')
      ->whereIn($table . '.produk_varian_id', $varians)
      ->select($table . '.id, ' . $table . '.harga, ' . $table . '.produk_varian_id, kp.id as pelanggan_id, kp.nama');
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
