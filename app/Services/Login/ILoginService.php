<?php

namespace App\Services\Login;

interface ILoginService
{
  public function checkLogin($email, $password);
}
