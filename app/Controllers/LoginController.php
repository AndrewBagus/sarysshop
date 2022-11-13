<?php

namespace App\Controllers;

use App\Services\Login\LoginService;

class LoginController extends BaseController
{
  private $userService;

  public function __construct()
  {
    $this->userService = new LoginService();
  }

  public function index()
  {
    return view('login/index');
  }

  public function login()
  {
    $data = $this->request->getPost();
    $email = $data['email'];
    $password = $data['password'];

    $response = $this->userService->checkLogin($email, $password);
    return json_encode($response);
  }
}
