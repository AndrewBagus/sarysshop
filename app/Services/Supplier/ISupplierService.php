<?php

namespace App\Services\Supplier;

interface ISupplierService
{
  public function getDataTable($request);
  public function getSuppliers();
  public function saveData($request);
  public function removeData($request);
}
