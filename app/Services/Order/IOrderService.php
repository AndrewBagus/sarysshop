<?php

namespace App\Services\Order;

interface IOrderService
{
    public function getDataTable($request);
    public function getOrderDetail($request);
    public function getProudukByOrders($request);
    public function getPembayaranByOrders($request);
    public function saveOrderPembayaran($request);
    public function saveOrderPengirimanPenerimaan($request, $tipe);
    public function saveData($request);
    public function removeData($request);
}
