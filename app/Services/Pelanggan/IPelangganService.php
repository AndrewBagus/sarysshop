<?php

namespace App\Services\Pelanggan;

interface IPelangganService
{
  public function getDataTable($request);
  public function getPelanggan();
  public function saveData($request);
  public function removeData($request);
}
