<?php

namespace App\Repositories\JenisBank;

interface IJenisBankRepository
{
  public function getActive();
  public function getById($id);
  public function save($data);
}
