<?php

namespace App\Repositories\JenisBank;

use App\Models\JenisBankModel;

class JenisBankRepository implements IJenisBankRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new JenisBankModel();
  }

  public function getActive()
  {
    return $this->model->where('is_active', true);
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
