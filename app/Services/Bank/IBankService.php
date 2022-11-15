<?php

namespace App\Services\Bank;

interface IBankService
{
  public function getDataTable($request);
  public function getBank();
  public function saveData($request);
  public function removeData($request);
}
