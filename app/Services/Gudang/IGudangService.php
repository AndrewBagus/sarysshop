<?php

namespace App\Services\Gudang;

interface IGudangService
{
  public function getDataTable($request);
  public function getGudang();
  public function saveData($request);
  public function removeData($request);
}
