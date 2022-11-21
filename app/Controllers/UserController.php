<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class UserController extends BaseController
{
  private $userService;
  public function __construct()
  {
    $this->userService = Services::userService();
  }

  public function getUsers(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->userService->getUsers($post);

    echo json_encode($response);
  }
}
