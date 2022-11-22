<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class GudangController extends BaseController
{
  private $gudangService;
  public function __construct()
  {
    $this->gudangService = Services::gudangService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Gudang',
      'parent' => 'Master Data',
    ];

    return view('gudang/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->gudangService->getDataTable($post);

    echo json_encode($response);
  }

  public function getGudangs(): void
  {
    $response = $this->gudangService->getGudang();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->gudangService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->gudangService->removeData($post);

    echo json_encode($response);
  }
}
