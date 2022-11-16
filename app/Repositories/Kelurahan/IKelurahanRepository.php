<?php

namespace App\Repositories\Kelurahan;

interface IKelurahanRepository
{
  public function getKelurahan($param);
  public function getKelurahanById($kelurahan_id);
}
