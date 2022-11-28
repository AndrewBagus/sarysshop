<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrderController extends BaseController
{
    // private $orderService;
    // public function __construct()
    // {
    //     $this->OrderService = Services::orderService();
    // }

    public function index($params = 'order'): string
    {
        $data = [
          'title' => 'Order',
          'parent' => 'root',
          'page' => $params
        ];

        return view('order/index', $data);
    }
}
