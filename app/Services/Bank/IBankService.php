<?php

namespace App\Services\Bank;

interface IBankService
{
  public function getDataTable($request);
  public function getBanks();
  public function saveData($request);
  public function removeData($request);
}
