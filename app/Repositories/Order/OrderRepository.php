<?php

namespace App\Repositories\Order;

use App\Models\OrderModel;

class OrderRepository implements IOrderRepository
{
    private $model;
    public $orderSelect;
    public function __construct()
    {
        $this->model = new OrderModel();
    }

    public function getActive()
    {
        return $this->model
            ->join('m_pelanggan mp1', 't_order.pelanggan_id = mp1.id')
            ->join('m_kategori_pelanggan kp1', 'mp1.kategori_pelanggan_id = kp1.id')
            ->join('m_pelanggan mp2', 't_order.pelanggan_kirim = mp2.id')
            ->join('m_kategori_pelanggan kp2', 'mp2.kategori_pelanggan_id = kp2.id')
            ->join('m_kurir mk', 't_order.kurir_id = mk.id')
            ->select(
                [
                't_order.id',
                't_order.kurir_id',
                't_order.code',
                't_order.tanggal_order',
                't_order.tanggal_dikirim',
                't_order.tanggal_diterima',
                't_order.status_pembayaran',
                't_order.grandtotal',
                't_order.biaya_kurir',
                't_order.no_resi',
                'mk.nama as kurir',
                'mp1.nama as pelanggan',
                'kp1.nama as jenis_pelanggan',
                'mp2.nama as kepada',
                'kp2.nama as jenis_kepada',
                '(select count(tod.id) from t_order_detail tod where tod.order_id = t_order.id) as produks'
                ]
            )
            ->where('t_order.is_active', true)
            ->orderBy('t_order.id', 'desc');
    }

    public function countAll()
    {
        return $this->model->countAllResults();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }

    public function getOrderDetail($order_id)
    {
    }
}
