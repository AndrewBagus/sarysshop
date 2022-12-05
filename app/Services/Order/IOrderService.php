<?php

namespace App\Services\Order;

interface IOrderService
{
    public function getDataTable($request);
    public function getOrders();
    public function saveData($request);
    public function removeData($request);
}
