<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\KategoriPelanggan\KategoriPelangganService;

class KategoriPelangganController extends BaseController
{
  private $kategoriPelangganService;
  public function __construct()
  {
    $this->kategoriPelangganService = new KategoriPelangganService();
  }

  public function index()
  {
    $data = [
      'title' => 'Kategori Pelanggan',
      'parent' => 'Master Data',
    ];

    return view('kategoriPelanggan/index', $data);
  }

  public function getDataTable()
  {
    $post = (object)$this->request->getVar();
    $response = $this->kategoriPelangganService->getDataTable($post);

    echo json_encode($response);
  }

  public function saveData()
  {
    $post = $this->request->getVar();
    $response = $this->kategoriPelangganService->saveData($post);

    echo json_encode($response);
  }

  public function removeData()
  {
    $post = $this->request->getVar();
    $response = $this->kategoriPelangganService->removeData($post);

    echo json_encode($response);
  }}
