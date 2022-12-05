<?php

namespace App\Repositories\OrderPembayaran;

interface IOrderPembayaranRepository
{
    public function getByOrder($order_id);
    public function save($data);
    public function removeByOrder($order_id);
    public function removeNotInOrder($order_id, $pembayarans);
}
