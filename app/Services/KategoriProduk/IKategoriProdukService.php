<?php

namespace App\Services\KategoriProduk;

interface IKategoriProdukService
{
  public function getDataTable($request);
  public function getKategoriProduks();
  public function saveData($request);
  public function removeData($request);
}
