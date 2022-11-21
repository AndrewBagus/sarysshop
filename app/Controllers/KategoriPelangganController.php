<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class KategoriPelangganController extends BaseController
{
  private $kategoriPelangganService;
  public function __construct()
  {
    $this->kategoriPelangganService = Services::kategoriPelangganService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Kategori Pelanggan',
      'parent' => 'Master Data',
    ];

    return view('kategoriPelanggan/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->kategoriPelangganService->getDataTable($post);

    echo json_encode($response);
  }

  public function getKategoriPelanggans(): void
  {
    $response = $this->kategoriPelangganService->getKategoriPelanggans();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->kategoriPelangganService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->kategoriPelangganService->removeData($post);

    echo json_encode($response);
  }
}
