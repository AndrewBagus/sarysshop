<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class JenisProdukController extends BaseController
{
  private $jenisProdukService;
  public function __construct()
  {
    $this->jenisProdukService = Services::jenisProdukService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Jenis Produk',
      'parent' => 'Master Data',
    ];

    return view('jenisProduk/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->jenisProdukService->getDataTable($post);

    echo json_encode($response);
  }

  public function getJenisProduks(): void
  {
    $response = $this->jenisProdukService->getjenisProduks();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->jenisProdukService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->jenisProdukService->removeData($post);

    echo json_encode($response);
  }
}
