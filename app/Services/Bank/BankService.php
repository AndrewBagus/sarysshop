<?php

namespace App\Services\Bank;

use App\Repositories\Bank\BankRepository;

class BankService implements IBankService
{
  private $bankRepo;

  public function __construct()
  {
    $this->bankRepo = new BankRepository();
  }

  private function _queryDataTable($search, $order)
  {
    $column = [
      'm_bank.id',
      'jb.nama',
      'm_bank.rekening',
      'm_bank.cabang',
      'm_bank.atas_nama'
    ];
    $column_order = $column; //field yang ada di table user
    $column_search = $column; //field yang diizin untuk pencarian
    $order_by = ['m_bank.id' => 'asc']; // default order

    $query = $this->bankRepo->getActive();

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
    $countAll = $this->bankRepo->getActive()
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

  public function getBank()
  {
    return $this->bankRepo->getActive();
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

    if((int)$data['jenis_bank_id'] === 0){
      $data['jenis_bank_id'] = null;
    }

    $this->bankRepo->save($data);

    $response = [
      'status' => true,
      'message' => $message
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->bankRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }
}
