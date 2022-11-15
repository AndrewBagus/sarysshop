<?php

namespace App\Services\KategoriProduk;

interface IKategoriProdukService
{
  public function getDataTable($request);
  public function getKategoriProduk();
  public function saveData($request);
  public function removeData($request);
}
