<?php

namespace App\Services\KategoriPelanggan;

interface IKategoriPelangganService
{
  public function getDataTable($request);
  public function getKategoriPelanggan();
  public function saveData($request);
  public function removeData($request);
}
