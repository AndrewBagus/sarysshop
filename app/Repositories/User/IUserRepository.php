<?php

namespace App\Repositories\User;

interface IUserRepository
{
  public function getById($id);
  public function getByEmail($id);
}
