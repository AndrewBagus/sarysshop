<?php

namespace App\Services\Pelanggan;

use App\Repositories\Pelanggan\PelangganRepository;

class PelangganService implements IPelangganService
{
  private $pelangganRepo;

  public function __construct()
  {
    $this->pelangganRepo = new PelangganRepository();
  }

  private function _queryDataTable($query, $search, $order)
  {
    $column = [
      'm_pelanggan.id',
      'kp.nama',
      'm_pelanggan.nama',
      'm_pelanggan.kode_pos',
      'm_pelanggan.telp',
      'm_pelanggan.email',
      'm_pelanggan.alamat',
      'kb.nama_propinsi',
      'kb.nama_kabupaten_kota',
      'kb.jenis_kabupaten_kota',
      'kb.nama_kecamatan',
      'kb.nama_kelurahan_desa',
      'kb.kode_pos',
    ];
    $column_order = $column; //field yang ada di table user
    $column_search = $column; //field yang diizin untuk pencarian
    $order_by = ['m_pelanggan.id' => 'asc']; // default order

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
    $kategori_pelanggan_id = $request->kategori_pelanggan_id;

    $query = $this->pelangganRepo->getActive();

    if (!empty($kategori_pelanggan_id))
      $query = $query->where('kategori_pelanggan_id', $kategori_pelanggan_id);

    $query = $this->_queryDataTable($query, $search, $order);
    if ($length != -1) {
      $query = $query->limit($length, $start);
    }
    $query = $query->get();

    $list = $query->getResult();
    $countFilltered = $query->getNumRows();
    $countAll = $this->pelangganRepo->getActive()
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

  public function getPelanggans()
  {
    return $this->pelangganRepo->getActive();
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

    $this->pelangganRepo->save($data);

    $response = [
      'status' => true,
      'message' => $message
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->pelangganRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }
}
