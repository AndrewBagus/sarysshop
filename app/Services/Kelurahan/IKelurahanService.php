<?php

namespace App\Services\Kelurahan;

interface IKelurahanService
{
  public function getKelurahan($param);
  public function getKelurahanById($kelurahan_id);
}
