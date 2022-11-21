<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class SupplierController extends BaseController
{
  private $supplierService;
  public function __construct()
  {
    $this->supplierService = Services::supplierService();
  }

  public function index(): string
  {
    $data = [
      'title' => 'Supplier',
      'parent' => 'Master Data',
    ];

    return view('supplier/index', $data);
  }

  public function getDataTable(): void
  {
    $post = (object)$this->request->getVar();
    $response = $this->supplierService->getDataTable($post);

    echo json_encode($response);
  }

  public function getSuppliers(): void
  {
    $response = $this->supplierService->getSuppliers();

    echo json_encode($response);
  }

  public function saveData(): void
  {
    $post = $this->request->getVar();
    $response = $this->supplierService->saveData($post);

    echo json_encode($response);
  }

  public function removeData(): void
  {
    $post = $this->request->getVar();
    $response = $this->supplierService->removeData($post);

    echo json_encode($response);
  }
}
