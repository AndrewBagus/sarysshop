<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
  public function __construct()
  {
  }

  public function index()
  {
    return view('login/index');
  }

  public function login()
  {
    $data = $this->request->getVar();
    $email = $data['email'];
    $password = $data['password'];

    dumpDie($data);

    $checkUser = $this->user->getByEmail($email);

    if (empty($checkUser)) {
      $response = [
        'status' => false,
        'message' => 'Username tidak di temukan',
      ];
      return json_encode($response);
    }

    if ($checkUser['is_active'] == false) {
      $response = [
        'status' => false,
        'message' => 'Username telah tidak aktif',
      ];
      return json_encode($response);
    }

    if ($checkUser['password'] != md5($password)) {
      $response = [
        'status' => false,
        'message' => 'Password salah',
      ];
      return json_encode($response);
    }

    $sessionData = [
      'user_id' => $checkUser['id'],
      'role_id' => $checkUser['role_id'],
      'fullname' => $checkUser['fullname'],
    ];
    $this->session->set($sessionData);

    $response = [
      'status' => true,
      'message' => 'Login telah berhasil',
    ];
    return json_encode($response);
  }
}
