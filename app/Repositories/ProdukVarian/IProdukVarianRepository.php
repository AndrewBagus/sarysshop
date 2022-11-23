<?php

namespace App\Repositories\ProdukVarian;

interface IProdukVarianRepository
{
  public function getById($id);
  public function checkCode($id, $code);
  public function getByProduk($produk_id);
  public function save($data);
}
