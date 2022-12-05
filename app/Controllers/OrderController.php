<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class OrderController extends BaseController
{
    private $orderService;
    public function __construct()
    {
        $this->orderService = Services::orderService();
    }

    public function index($params = 'order'): string
    {
        $data = [
        'title' => 'Order',
        'parent' => 'root',
        'page' => $params
        ];

        return view('order/index', $data);
    }

    public function getDataTable(): void
    {
        $post = (object)$this->request->getVar();
        $response = $this->orderService->getDataTable($post);

        echo json_encode($response);
    }

    // public function getOrderDetail()
    // {
    //     $post = (object) $this->request->getVar();
    //     $response = $this->orderService->getOrderDetail($post);
    //
    //     echo json_encode($response);
    // }

    public function getOrderProduk()
    {
        $post = (object) $this->request->getVar();
        $response = $this->orderService->getProudukByOrders($post);

        echo json_encode($response);
    }

    public function getOrderPembayaran()
    {
        $post = (object) $this->request->getVar();
        $response = $this->orderService->getPembayaranByOrders($post);

        echo json_encode($response);
    }

    public function saveOrder(): void
    {
        $post = $this->request->getVar();
        $response = $this->orderService->saveData($post);

        echo json_encode($response);
    }
}
