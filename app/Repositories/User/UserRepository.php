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

  public function getActive()
  {
    return $this->model
      ->join('m_role r', 'm_user.role_id = r.id')
      ->select('m_user.id, m_user.role_id, m_user.nama, m_user.email, m_user.telp, r.nama as role')
      ->where('m_user.is_active', true);
  }

  public function getNotIn($filter)
  {
    return $this->model
      ->join('m_role r', 'm_user.role_id = r.id')
      ->select('m_user.id, m_user.role_id, m_user.nama, m_user.email, m_user.telp, r.nama as role')
      ->where('m_user.is_active', true)
      ->whereNotIn('m_user.id', $filter);
  }

  public function getById($id)
  {
    return $this->model
      ->join('m_role r', 'm_user.role_id = r.id')
      ->select('m_user.id, m_user.role_id, m_user.nama, m_user.email, m_user.telp, r.nama as role')
      ->where('id', $id)
      ->where('is_active', true)
      ->get()
      ->getRow();
  }

  public function getByEmail($email)
  {
    return $this->model
      ->select('id, role_id, nama, password, is_active')
      ->where('email', $email)
      ->get()
      ->getRow();
  }

  public function save($data)
  {
    return $this->model->save($data);
  }
}
