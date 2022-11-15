<?php

namespace App\Services\Login;

use App\Repositories\User\UserRepository;
use Config\Services;

class LoginService implements ILoginService
{
  private $userRepo;

  public function __construct()
  {
    $this->userRepo = new UserRepository();
  }

  public function checkLogin($email, $password)
  {
    $response = [];
    $user = $this->userRepo->getByEmail($email);
    if (empty($user)) {
      $response = [
        'status' => false,
        'message' => 'Email tidak terdaftar'
      ];
      return $response;
    }

    if ($user->password !== md5($password)) {
      $response = [
        'status' => false,
        'message' => 'Password yang anda masukkan salah'
      ];

      return $response;
    }

    $session = [
      'user_id' => $user->id,
      'role_id' => $user->role_id,
      'fullname' => $user->nama,
    ];
    Services::session()->set($session);

    $response = [
      'status' => true,
      'message' => 'Login telah berhasil',
    ];
    return $response;
  }
}
