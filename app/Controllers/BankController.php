<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class BankController extends BaseController
{
  private $bankService;
  public function __construct()
  {
    $this->bankService = Services::BankService();
  }

  public function index()
  {
    $data = [
      'title' => 'Bank',
      'parent' => 'Master Data',
    ];

    return view('bank/index', $data);
  }

  public function getDataTable()
  {
    $post = (object)$this->request->getVar();
    $response = $this->bankService->getDataTable($post);

    echo json_encode($response);
  }

  public function getBanks()
  {
    $response = $this->bankService->getBanks();

    echo json_encode($response);
  }

  public function saveData()
  {
    $post = $this->request->getVar();
    $response = $this->bankService->saveData($post);

    echo json_encode($response);
  }

  public function removeData()
  {
    $post = $this->request->getVar();
    $response = $this->bankService->removeData($post);

    echo json_encode($response);
  }
}
