<?php

namespace App\Repositories\Produk;

use App\Models\ProdukModel;

class ProdukRepository implements IProdukRepository
{
  private $model;
  public $produkSelect;
  public function __construct()
  {
    $this->model = new ProdukModel();

    $getVarian = "(select id from m_produk_varian where produk_id = m_produk.id and is_active = true)";
    $varianQuery = "(select count(pv.id) from m_produk_varian pv join m_produk pr on pv.produk_id = pr.id where pv.produk_id = m_produk.id and pv.is_active = true) as varian";
    $stokQuery = "(select sum(pv.stok) from m_produk_varian pv join m_produk pr on pv.produk_id = pr.id where pv.produk_id = m_produk.id and pv.is_active = true) as stok";
    $minPriceQuery = "(select min(harga) from m_produk_varian_harga where produk_varian_id in " . $getVarian . ") as min_harga";
    $maxPriceQuery = "(select max(harga) from m_produk_varian_harga where produk_varian_id in " . $getVarian . ") as max_harga";

    $this->produkSelect = [
      'm_produk.id',
      'm_produk.kategori_produk_id',
      'm_produk.jenis_produk_id',
      'm_produk.gudang_id',
      'm_produk.supplier_id',
      'm_produk.nama',
      'm_produk.image',
      'm_produk.tempo_kedatangan',
      'm_produk.keterangan',
      'm_produk.is_active',
      'su.nama as supplier',
      'su.alamat as supplier_alamat',
      'kp.nama as kategori_produk',
      'jp.nama as jenis_produk',
      'gu.nama as gudang',
      'gu.alamat as alamat',
      $stokQuery,
      $varianQuery,
      $minPriceQuery,
      $maxPriceQuery
    ];
  }

  public function getActive()
  {
    $produk = implode(',', $this->produkSelect);
    return $this->model
      ->join('m_supplier as su', 'm_produk.supplier_id = su.id')
      ->join('m_kategori_produk as kp', 'm_produk.kategori_produk_id = kp.id')
      ->join('m_jenis_produk as jp', 'm_produk.jenis_produk_id = jp.id')
      ->join('m_gudang as gu', 'm_produk.gudang_id = gu.id')
      ->select($produk)
      ->where('m_produk.is_active', true);
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
