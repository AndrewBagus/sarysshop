<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class GudangController extends BaseController
{
  private $gudangService;
  public function __construct()
  {
    $this->gudangService = Services::GudangService();
  }

  public function index()
  {
    $data = [
      'title' => 'Gudang',
      'parent' => 'Master Data',
    ];

    return view('gudang/index', $data);
  }

  public function getDataTable()
  {
    $post = (object)$this->request->getVar();
    $response = $this->gudangService->getDataTable($post);

    echo json_encode($response);
  }

  public function getGudang()
  {
    $response = $this->gudangService->getGudang();

    echo json_encode($response);
  }

  public function saveData()
  {
    $post = $this->request->getVar();
    $response = $this->gudangService->saveData($post);

    echo json_encode($response);
  }

  public function removeData()
  {
    $post = $this->request->getVar();
    $response = $this->gudangService->removeData($post);

    echo json_encode($response);
  }
}
