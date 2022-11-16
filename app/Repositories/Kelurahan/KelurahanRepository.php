<?php

namespace App\Repositories\Kelurahan;

use App\Models\KelurahanModel;

class KelurahanRepository implements IKelurahanRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new KelurahanModel();
  }

  public function getKelurahan($param)
  {
    return $this->model
      ->select("id, kode_pos, CONCAT(nama_kecamatan, ', ', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ', ', nama_propinsi) AS kecamatan")
      ->like("CONCAT(nama_kecamatan, ', ', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ', ', nama_propinsi)", "%" . $param . "%")
      ->groupBy('nama_kecamatan')
      ->limit(10)
      ->get()
      ->getResult();
  }

  public function getKelurahanById($kelurahan_id)
  {
    return $this->model
      ->select("id, kode_pos, CONCAT(nama_kecamatan, ', ', jenis_kabupaten_kota, ' ', nama_kabupaten_kota, ', ', nama_propinsi) AS kecamatan")
      ->where('id', $kelurahan_id)
      ->get()
      ->getRow();
  }
}
