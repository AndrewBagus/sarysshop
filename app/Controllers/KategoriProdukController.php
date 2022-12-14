<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class KategoriProdukController extends BaseController
{
  private $kategoriProdukService;
  public function __construct()
  {
    $this->kategoriProdukService = Services::kategoriProdukService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Kategori Produk',
      'parent' => 'Master Data',
    ];

    return view('kategoriProduk/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->kategoriProdukService->getDataTable($post);

    echo json_encode($response);
  }

  public function getKategoriProduks(): void
  {
    $response = $this->kategoriProdukService->getKategoriProduks();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->kategoriProdukService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->kategoriProdukService->removeData($post);

    echo json_encode($response);
  }
}
