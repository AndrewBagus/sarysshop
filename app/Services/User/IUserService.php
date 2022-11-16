<?php

namespace App\Services\User;

interface IUserService
{
  public function getDataTable($request);
  public function getUsers($request);
  public function getUserById($id);
  public function saveData($request);
  public function removeData($request);
}
