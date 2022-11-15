<?php

namespace App\Repositories\Bank;

interface IBankRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
