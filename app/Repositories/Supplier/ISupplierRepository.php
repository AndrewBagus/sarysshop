<?php

namespace App\Repositories\Supplier;

interface ISupplierRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
