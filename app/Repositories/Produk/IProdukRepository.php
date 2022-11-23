<?php

namespace App\Repositories\Produk;

interface IProdukRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
