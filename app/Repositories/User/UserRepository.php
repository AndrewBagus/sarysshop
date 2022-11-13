<?php

namespace App\Repositories\User;

use App\Models\UserModel;

class UserRepository implements IUserRepository
{
  protected $model;

  public function __construct()
  {
    $this->model = new UserModel();
  }

  public function getById($id)
  {
    return $this->model->where('id', $id)->get()->getRow();
  }

  public function getByEmail($email)
  {
    return $this->model->where('email', $email)->get()->getRow();
  }
}
