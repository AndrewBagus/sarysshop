<?php

namespace App\Repositories\Pelanggan;

interface IPelangganRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
