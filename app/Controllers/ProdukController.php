<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class ProdukController extends BaseController
{
  private $produkService;
  public function __construct()
  {
    $this->produkService = Services::produkService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Daftar Produk',
      'parent' => 'Produk',
    ];

    return view('produk/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->produkService->getDataTable($post);

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->produkService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->produkService->removeData($post);

    echo json_encode($response);
  }
}
