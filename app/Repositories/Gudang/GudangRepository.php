<?php

namespace App\Repositories\Gudang;

use App\Models\GudangModel;

class GudangRepository implements IGudangRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new GudangModel();
  }

  public function getActive()
  {
    return $this->model
      ->join('m_kelurahan_desa kb', 'm_gudang.kelurahan_id = kb.id', 'left')
      ->select("m_gudang.* , CONCAT(kb.nama_kecamatan, ', ', kb.jenis_kabupaten_kota, ' ', kb.nama_kabupaten_kota, ', ', kb.nama_propinsi) AS kecamatan")
      ->where('m_gudang.is_active', true);
  }

  public function getById($id)
  {
    return $this->model->where('id', $id);
  }

  public function save($data)
  {
    return $this->model->save($data);
  }
}
