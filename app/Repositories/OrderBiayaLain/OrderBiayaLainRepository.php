<?php

namespace App\Repositories\OrderBiayaLain;

use App\Models\OrderBiayaLainModel;

class OrderBiayaLainRepository implements IOrderBiayaLainRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderBiayaLainModel();
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

    public function removeNotInOrder($order_id, $pembayarans)
    {
        return $this->model
            ->where('order_id', $order_id)
            ->whereNotIn('id', $pembayarans)
            ->delete();
    }
}
