<?php

namespace App\Services\Supplier;

interface ISupplierService
{
  public function getDataTable($request);
  public function getSupplier();
  public function saveData($request);
  public function removeData($request);
}
