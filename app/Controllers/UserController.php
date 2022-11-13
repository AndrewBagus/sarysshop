<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class UserController extends BaseController
{

  public function index()
  {
    $data = $this->userRepository->getByUserId(1);

    return json_decode($data);
  }

  public function getByUserId()
  {
    $data = Services::showUser()->showUserById(1);

    return json_encode($data);
  }
}
