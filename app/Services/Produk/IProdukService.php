<?php

namespace App\Services\Produk;

interface IProdukService
{
  public function getDataTable($request);
  public function getProduks();
  public function getProdukVarians($request);
  public function saveData($request);
  public function removeData($request);
}
