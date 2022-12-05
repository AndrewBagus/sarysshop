<?php

namespace App\Repositories\OrderDiskon;

use App\Models\OrderDiskonModel;

class OrderDiskonRepository implements IOrderDiskonRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderDiskonModel();
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
