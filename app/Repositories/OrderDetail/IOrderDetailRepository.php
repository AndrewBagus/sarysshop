<?php

namespace App\Repositories\OrderDetail;

interface IOrderDetailRepository
{
    public function getByOrder($order_id);
    public function getByOrderVarian($order_id, $varian_id);
    public function save($data);
    public function removeNotInOrder($order_id, $details);
}
