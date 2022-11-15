<?php

namespace App\Services\KategoriPelanggan;

interface IKategoriPelangganService
{
  public function getDataTable($request);
  public function saveData($request);
}
