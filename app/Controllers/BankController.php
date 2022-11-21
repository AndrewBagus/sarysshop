<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class BankController extends BaseController
{
  private $bankService;
  public function __construct()
  {
    $this->bankService = Services::bankService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Bank',
      'parent' => 'Master Data',
    ];

    return view('bank/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->bankService->getDataTable($post);

    echo json_encode($response);
  }

  public function getBanks(): void
  {
    $response = $this->bankService->getBanks();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->bankService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->bankService->removeData($post);

    echo json_encode($response);
  }
}
