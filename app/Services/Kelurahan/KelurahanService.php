<?php

namespace App\Services\Kelurahan;

use App\Repositories\Kelurahan\KelurahanRepository;

class KelurahanService implements IKelurahanService
{
  private $kelurahanRepo;

  public function __construct()
  {
    $this->kelurahanRepo = new KelurahanRepository();
  }

  public function getKelurahan($request)
  {
    return $this->kelurahanRepo->getKelurahan($request->search_data);
  }

  public function getKelurahanById($request)
  {
    return $this->kelurahanRepo->getKelurahanById($request->kelurahan_id);
  }
}
