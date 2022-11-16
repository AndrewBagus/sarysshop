<?php

namespace App\Services\KategoriPelanggan;

interface IKategoriPelangganService
{
  public function getDataTable($request);
  public function getKategoriPelanggans();
  public function saveData($request);
  public function removeData($request);
}
