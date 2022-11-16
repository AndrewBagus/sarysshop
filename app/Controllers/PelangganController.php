<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class PelangganController extends BaseController
{
  private $pelangganService;
  public function __construct()
  {
    $this->pelangganService = Services::pelangganService();
  }

  public function index()
  {
    $data = [
      'title' => 'Pelanggan',
      'parent' => 'Master Data',
    ];

    return view('pelanggan/index', $data);
  }

  public function getDataTable()
  {
    $post = (object)$this->request->getVar();
    $response = $this->pelangganService->getDataTable($post);

    echo json_encode($response);
  }

  public function getPelanggans()
  {
    $response = $this->pelangganService->getPelanggans();

    echo json_encode($response);
  }

  public function saveData()
  {
    $post = $this->request->getVar();
    $response = $this->pelangganService->saveData($post);

    echo json_encode($response);
  }

  public function removeData()
  {
    $post = $this->request->getVar();
    $response = $this->pelangganService->removeData($post);

    echo json_encode($response);
  }
}
