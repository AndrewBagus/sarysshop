<?php

namespace App\Repositories\OrderPembayaran;

use App\Models\OrderPembayaranModel;

class OrderPembayaranRepository implements IOrderPembayaranRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderPembayaranModel();
    }

    public function getByOrder($order_id)
    {
        return $this->model->where('order_id', $order_id)
            ->get()
            ->getResult();
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }

    public function removeByOrder($order_id)
    {
        return $this->model
            ->where('order_id', $order_id)
            ->delete();
    }

    public function removeNotInOrder($order_id, $diskons)
    {
        return $this->model
            ->where('order_id', $order_id)
            ->whereNotIn('id', $diskons)
            ->delete();
    }
}
