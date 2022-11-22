<?php

namespace App\Services\JenisBank;

interface IJenisBankService
{
  public function getDataTable($request);
  public function getJenisBanks();
  public function saveData($request);
  public function removeData($request);
}
