<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetailModel;

class OrderDetailRepository implements IOrderDetailRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderDetailModel();
    }

    public function getByOrder($order_id)
    {
        return $this->model->where('order_id', $order_id)
            ->get()
            ->getResult();
    }

    public function getByOrderVarian($order_id, $varian_id)
    {
        return $this->model->where('order_id', $order_id)
            ->where('produk_varian_id', $varian_id)
            ->get()
            ->getRow();
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }

    public function removeNotInOrder($order_id, $details)
    {
        return $this->model
            ->where('order_id', $order_id)
            ->whereNotIn('id', $details)
            ->delete();
    }

}
