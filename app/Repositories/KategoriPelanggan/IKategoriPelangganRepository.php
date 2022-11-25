<?php

namespace App\Repositories\KategoriPelanggan;

interface IKategoriPelangganRepository
{
  public function getActive();
  public function getById($id);
  public function getInProduk($produks);
  public function save($data);
}
