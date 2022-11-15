<?php

namespace App\Services\JenisBank;

interface IJenisBankService
{
  public function getDataTable($request);
  public function getJenisBank();
  public function saveData($request);
  public function removeData($request);
}
