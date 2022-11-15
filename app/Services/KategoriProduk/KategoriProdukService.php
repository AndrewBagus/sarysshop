<?php

namespace App\Services\KategoriProduk;

use App\Repositories\KategoriProduk\KategoriProdukRepository;

class KategoriProdukService implements IKategoriProdukService
{
  private $kategoriProdukRepo;

  public function __construct()
  {
    $this->kategoriProdukRepo = new KategoriProdukRepository();
  }

  private function _queryDataTable($search, $order)
  {
    $column_order = ['id', 'nama']; //field yang ada di table user
    $column_search = ['id', 'nama']; //field yang diizin untuk pencarian
    $order_by = ['id' => 'asc']; // default order

    $query = $this->kategoriProdukRepo->getActive();

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

    $query = $this->_queryDataTable($search, $order);
    if ($length != -1) {
      $query = $query->limit($length, $start);
    }
    $query = $query->get();

    $list = $query->getResult();
    $countFilltered = $query->getNumRows();
    $countAll = $this->kategoriProdukRepo->getActive()
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

  public function getKategoriProduk()
  {
    return $this->kategoriProdukRepo->getActive()->get()->getResult();
  }

  public function saveData($data)
  {
    $message = 'Data berhasil disimpan';
    if ((int)$data['id'] > 0) {
      $message = 'Data berhasil diubah';
      $data['updated_at'] = date('Y-m-d H:i:s');
    } else {
      $data['created_by'] = session()->get('user_id');
    }
    $this->kategoriProdukRepo->save($data);

    $response = [
      'status' => true,
      'message' => $message
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->kategoriProdukRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }
}
