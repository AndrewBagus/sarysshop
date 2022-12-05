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
        $tbl = 't_order_pembayaran';
        return $this->model->where('order_id', $order_id)
            ->join('m_bank mb', $tbl . '.bank_id = mb.id')
            ->join('m_jenis_bank jb', 'mb.jenis_bank_id = jb.id')
            ->select(
                $tbl . '.*,
                mb.rekening,
                mb.atas_nama,
                mb.cabang,
                jb.nama as jenis_bank'
            )
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
