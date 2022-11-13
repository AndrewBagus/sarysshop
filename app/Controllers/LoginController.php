<?php

namespace App\Controllers;

use Config\Services;

class LoginController extends BaseController
{
  private $loginService;

  public function __construct()
  {
    $this->loginService = Services::loginService();
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

    $response = $this->loginService->checkLogin($email, $password);
    return json_encode($response);
  }

  public function logout()
  {
    $this->session->destroy();
    return redirect()->to('login');
  }
}
