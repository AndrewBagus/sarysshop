<?php

namespace App\Repositories\Bank;

use App\Models\BankModel;

class BankRepository implements IBankRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new BankModel();
  }

  public function getActive()
  {
    return $this->model
      ->join('m_jenis_bank jb', 'm_bank.jenis_bank_id = jb.id', 'left')
      ->select('m_bank.*, jb.nama as jenis_bank')
      ->where('m_bank.is_active', true);
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
