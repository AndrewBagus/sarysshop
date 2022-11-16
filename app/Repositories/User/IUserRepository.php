<?php

namespace App\Repositories\User;

interface IUserRepository
{
  public function getActive();
  public function getById($id);
  public function getByEmail($id);
  public function getNotIn($fitler);
  public function save($data);
}
