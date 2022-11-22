<?php

namespace App\Services\Gudang;

use App\Repositories\Gudang\GudangRepository;

class GudangService implements IGudangService
{
  private $gudangRepo;

  public function __construct()
  {
    $this->gudangRepo = new GudangRepository();
  }

  private function _queryDataTable($query, $search, $order)
  {
    $column = [
      'm_gudang.id',
      'm_gudang.nama',
      'm_gudang.kode_pos',
      'm_gudang.telp',
      'm_gudang.alamat',
      'kb.nama_propinsi',
      'kb.nama_kabupaten_kota',
      'kb.jenis_kabupaten_kota',
      'kb.nama_kecamatan',
      'kb.nama_kelurahan_desa',
      'kb.kode_pos',
    ];
    $column_order = $column; //field yang ada di table user
    $column_search = $column; //field yang diizin untuk pencarian
    $order_by = ['m_gudang.id' => 'asc']; // default order

    $query = datatableQuery($query, $search, $column_search, $column_order, $order, $order_by);

    return $query;
  }

  public function getDataTable($request)
  {
    $search = $request->search;
    $order = $request->order;
    $length = $request->length;
    $start = $request->start;
    $draw = $request->draw;

    $query = $this->gudangRepo->getActive();

    $query = $this->_queryDataTable($query, $search, $order);
    if ($length != -1) {
      $query = $query->limit($length, $start);
    }
    $query = $query->get();

    $list = $query->getResult();
    $countFilltered = $query->getNumRows();
    $countAll = $this->gudangRepo->getActive()
      ->get()
      ->getNumRows();

    foreach ($list as $i => $v) {
      $start++;
      $list[$i]->no = $start;
    }

    $response = [
      "draw" => $draw,
      "recordsTotal" => $countFilltered,
      "recordsFiltered" => $countAll,
      "data" => $list,
    ];

    return $response;
  }

  public function getGudang()
  {
    return $this->gudangRepo
      ->getActive()
      ->get()
      ->getResult();
  }

  public function saveData($data)
  {
    $message = 'Data berhasil disimpan';
    if ((int)$data['id'] > 0) {
      $message = 'Data berhasil diubah';

      $data['updated_by'] = session()->get('user_id');
      $data['updated_at'] = date('Y-m-d H:i:s');
    } else {
      $data['created_by'] = session()->get('user_id');
    }

    $gudang_id = $this->gudangRepo->save($data);

    $response = [
      'status' => true,
      'message' => $message,
      'gudang_id' => $gudang_id
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->gudangRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }
}
