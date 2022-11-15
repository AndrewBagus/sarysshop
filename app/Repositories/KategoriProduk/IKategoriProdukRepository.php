<?php

namespace App\Repositories\KategoriProduk;

interface IKategoriProdukRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
