<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;

class UserService implements IUserService
{
  private $userRepo;

  public function __construct()
  {
    $this->userRepo = new UserRepository();
  }

  private function _queryDataTable($query, $search, $order)
  {
    $column = [
      'm_user.id',
      'm_user.nama',
      'm_user.telp',
      'm_user.email',
      'r.nama',
    ];
    $column_order = $column; //field yang ada di table user
    $column_search = $column; //field yang diizin untuk pencarian
    $order_by = ['m_user.id' => 'asc']; // default order

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

    $query = $this->userRepo->getActive();

    $query = $this->_queryDataTable($query, $search, $order);
    if ($length != -1) {
      $query = $query->limit($length, $start);
    }
    $query = $query->get();

    $list = $query->getResult();
    $countFilltered = $query->getNumRows();
    $countAll = $this->userRepo->getActive()
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

  public function getUsers($request)
  {
    $users = [];
    $admins = empty($request->admins) ? [] : json_decode($request->admins);
    $filter = count($admins) === 0 ? [] : array_column($admins, 'id');

    if(count($filter) > 0) {
      $users = $this->userRepo
      ->getNotIn($filter)
      ->get()
      ->getResult();
    } else {
      $users = $this->userRepo
      ->getActive()
      ->get()
      ->getResult();
    }
    return $users;
  }

  public function getUserById($id)
  {
    return $this->userRepo->getById($id);
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

    $this->userRepo->save($data);

    $response = [
      'status' => true,
      'message' => $message
    ];

    return $response;
  }

  public function removeData($data)
  {
    $data['is_active'] = false;
    $this->userRepo->save($data);

    $response = [
      'status' => true,
      'message' => 'Data berhasil dihapus'
    ];

    return $response;
  }
}
