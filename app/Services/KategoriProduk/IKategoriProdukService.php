<?php

namespace App\Services\KategoriProduk;

interface IKategoriProdukService
{
  public function getDataTable($request);
  public function saveData($request);
}
