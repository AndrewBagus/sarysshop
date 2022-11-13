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

  public function showUserById($id)
  {
    return $this->userRepo->getByUserId($id);
  }
}
