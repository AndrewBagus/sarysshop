<?php

namespace App\Repositories\JenisProduk;

interface IJenisProdukRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
