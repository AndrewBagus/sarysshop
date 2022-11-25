<?php

namespace App\Repositories\ProdukVarianHarga;

interface IProdukVarianHargaRepository
{
  public function getById($id);
  public function getByVarian($varian_id);
  public function getInVarians($varians);
  public function getByVarianKategoriPelanggan($varian_id, $kategori_pelanggan_id);
  public function save($data);
}
