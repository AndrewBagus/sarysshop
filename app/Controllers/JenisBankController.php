<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class JenisBankController extends BaseController
{
  private $jenisBankService;
  public function __construct()
  {
    $this->jenisBankService = Services::jenisBankService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Jenis Bank',
      'parent' => 'Master Data',
    ];

    return view('jenisBank/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->jenisBankService->getDataTable($post);

    echo json_encode($response);
  }

  public function getJenisBank(): void
  {
    $response = $this->jenisBankService->getjenisBank();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->jenisBankService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->jenisBankService->removeData($post);

    echo json_encode($response);
  }
}
