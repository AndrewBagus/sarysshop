<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\KategoriProduk\KategoriProdukService;

class KategoriProdukController extends BaseController
{
  private $kategoriProdukService;
  public function __construct()
  {
    $this->kategoriProdukService = new KategoriProdukService();
  }

  public function index()
  {
    $data = [
      'title' => 'Kategori Produk',
      'parent' => 'Master Data',
    ];

    return view('kategoriProduk/index', $data);
  }

  public function getDataTable()
  {
    $post = (object)$this->request->getVar();
    $response = $this->kategoriProdukService->getDataTable($post);

    echo json_encode($response);
  }

  public function saveData()
  {
    $post = $this->request->getVar();
    $response = $this->kategoriProdukService->saveData($post);

    echo json_encode($response);
  }

  public function removeData()
  {
    $post = $this->request->getVar();
    $response = $this->kategoriProdukService->removeData($post);

    echo json_encode($response);
  }
}
