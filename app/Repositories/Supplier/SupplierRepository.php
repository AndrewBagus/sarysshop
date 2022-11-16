<?php

namespace App\Repositories\Supplier;

use App\Models\SupplierModel;

class SupplierRepository implements ISupplierRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new SupplierModel();
  }

  public function getActive()
  {
    return $this->model
      ->join('m_kelurahan_desa kb', 'm_supplier.kelurahan_id = kb.id', 'left')
      ->select("m_supplier.* , CONCAT(kb.nama_kecamatan, ', ', kb.jenis_kabupaten_kota, ' ', kb.nama_kabupaten_kota, ', ', kb.nama_propinsi) AS kecamatan")
      ->where('m_supplier.is_active', true);
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
