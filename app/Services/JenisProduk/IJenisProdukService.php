<?php

namespace App\Services\JenisProduk;

interface IJenisProdukService
{
  public function getDataTable($request);
  public function getJenisProduks();
  public function saveData($request);
  public function removeData($request);
}
