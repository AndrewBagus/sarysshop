<?php

namespace App\Repositories\Gudang;

interface IGudangRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
