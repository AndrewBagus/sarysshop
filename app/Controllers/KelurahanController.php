<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class KelurahanController extends BaseController
{
  private $kelurahanService;
  public function __construct()
  {
    $this->kelurahanService = Services::kelurahanService();
  }

  public function getKelurahan()
  {
    $post = (object)$this->request->getVar();
    $response = $this->kelurahanService->getKelurahan($post);

    echo json_encode($response);
  }

  public function getKelurahanById()
  {
    $post = (object)$this->request->getVar();
    $response = $this->kelurahanService->getKelurahanById($post);

    echo json_encode($response);
  }
}
