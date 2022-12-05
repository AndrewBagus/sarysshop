<?php

namespace App\Services\Order;

use App\Repositories\OrderDiskon\OrderDiskonRepository;
use App\Repositories\OrderPembayaran\OrderPembayaranRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderBiayaLain\OrderBiayaLainRepository;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\ProdukVarian\ProdukVarianRepository;
use Config\Database;

class OrderService implements IOrderService
{
    private $orderRepo;
    private $orderDetailRepo;
    private $orderDiskonRepo;
    private $orderBiayaLainRepo;
    private $orderPembayaranRepo;
    private $proudukVarianRepo;

    public function __construct()
    {
        $this->orderRepo = new OrderRepository();
        $this->orderDetailRepo = new OrderDetailRepository();
        $this->orderDiskonRepo = new OrderDiskonRepository();
        $this->orderBiayaLainRepo = new OrderBiayaLainRepository;
        $this->orderPembayaranRepo = new OrderPembayaranRepository();
        $this->proudukVarianRepo = new ProdukVarianRepository();
    }

    private function _queryDataTable($search, $order)
    {
        $columns = [
        't_order.id',
        't_order.code',
        't_order.tanggal_order',
        't_order.tanggal_dikirim',
        't_order.tanggal_diterima',
        't_order.status_pembayaran',
        't_order.grandtotal',
        'mk.nama',
        'mp1.nama',
        'kp1.nama',
        'mp2.nama',
        'kp2.nama',
        '(select count(tod.id) from t_order_detail tod where tod.order_id = t_order.id)'
        ];
        $column_order = $columns; //field yang ada di table user
        $column_search = $columns; //field yang diizin untuk pencarian
        $order_by = ['id' => 'desc']; // default order

        $query = $this->orderRepo->getActive();

        $query = datatableQuery($query, $search, $column_search, $column_order, $order, $order_by);

        return $query;
    }

    public function getDataTable($request)
    {
        $search = $request->search;
        $order = $request->order;
        $length = $request->length;
        $start = $request->start;
        $draw = $request->draw;
        $status = $request->status;


        $query = $this->_queryDataTable($search, $order);
        if ($length != -1) {
            $query = $query->limit($length, $start);
        }
        if ($status === 'belum-bayar') {
            $query = $query->where('t_order.status_pembayaran', 'belum-bayar');
        } else if ($status === 'sudah-dp') {
            $query = $query->where('t_order.status_pembayaran', 'cicilan');
        } else if ($status === 'sudah-lunas') {
            $query = $query->where('t_order.status_pembayaran', 'lunas');
        } else if ($status === 'pengiriman') {
            $query = $query->where('t_order.tanggal_dikirim !=', null);
            $query = $query->where('t_order.tanggal_diterima', null);
        } else if ($status === 'terkirim') {
            $query = $query->where('t_order.tanggal_diterima !=', null);
        }

        $query = $query->get();

        $list = $query->getResult();
        $countFilltered = $query->getNumRows();
        $countAll = $this->orderRepo->getActive()
            ->get()
            ->getNumRows();

        foreach ($list as $i => $v) {
            $start++;
            $list[$i]->no = $start;
        }

        $response = [
        "draw" => $draw,
        "recordsTotal" => $countFilltered,
        "recordsFiltered" => $countAll,
        "data" => $list,
        ];


        return $response;
    }

    public function getOrders()
    {
        return $this->orderRepo->getActive()->get()->getResult();
    }

    public function getProudukByOrders($request)
    {
        $order_id = $request->order_id;
        $produks = $this->proudukVarianRepo->getByOrder($order_id);
        $diskons = $this->orderDiskonRepo->getByOrder($order_id);
        $biayas = $this->orderBiayaLainRepo->getByOrder($order_id);

        $response = [
        'produks' => $produks,
        'diskons' => $diskons,
        'biayas' => $biayas
        ];

        return $response;
    }

    public function getPembayaranByOrders($request)
    {
        $order_id = $request->order_id;
        $pembayarans = $this->orderPembayaranRepo->getByOrder($order_id);

        return $pembayarans;
    }

    public function saveData($request)
    {
        $message = 'Data berhasil disimpan';
        $order = json_decode($request['order']);
        $produks = json_decode($request['produks']);
        $kurir = json_decode($request['kurir']);
        $diskons = json_decode($request['diskons']);
        $additionals = json_decode($request['additionals']);
        $pembayarans = json_decode($request['pembayarans']);

        $orderData = [
        'id' => $order->id,
        'pelanggan_id' => $order->pelanggan_id,
        'pelanggan_kirim' => $order->pelanggan_kirim,
        'user_id' => session()->get('user_id'),
        'kurir_id' => $kurir->id,
        'tanggal_order' => $order->tgl_order,
        'note' => $order->keterangan,
        'biaya_kurir' => $kurir->biaya,
        'total_berat' => $kurir->berat,
        'subtotal_pembelian' => $order->subtotal_pembelian,
        'grandtotal' => $order->grandtotal,
        ];

        if ($order->id === '0') {
            $orderNumber = sprintf("%02s", date('m'));
            $all = $this->orderRepo->countAll() + 1;
            $orderNumber .= sprintf("%05s", $all);
            $orderData['code'] =  $orderNumber;
            $orderData['created_by'] = session()->user_id;
        } else {
            $message = 'Data berhasil diubah';
            $orderData['updated_by'] = session()->user_id;
            $orderData['updated_at'] = date('Y-m-d H:i:s');
        }

        $db = Database::connect();
        $db->transStart();
        $order_id = $this->orderRepo->save($orderData);
        $order_id = $order_id === 0 ? $orderData['id'] : $order_id;

        foreach ($produks as $i => $produk) {
            $produkData = [
            'id' => $produk->id,
            'order_id' => $order_id,
            'produk_varian_id' => $produk->produk_varian_id,
            'qty' => $produk->qty,
            'harga' => $produk->harga,
            'berat' => $produk->subBerat,
            'diskon_tipe' => $produk->diskon_tipe,
            'diskon_persen' => $produk->diskon_persen,
            'diskon_nominal' => $produk->diskon_nominal,
            'subtotal' => $produk->subtotal,
            ];

            $checkDetail = $this->orderDetailRepo->getByOrderVarian($order_id, $produk->id);
            if (!empty($checkDetail)) {
                $produkData['id'] = $checkDetail->id;
            }
            $detail_id = $this->orderDetailRepo->save($produkData);
            $produks[$i]->id = $detail_id === 0 ? $produkData['id'] : $detail_id;
        }
        $this->orderDetailRepo->removeNotInOrder($order_id, array_column((array)$produks, 'id'));

        foreach ($diskons as $i => $diskon) {
            $diskon = (array)$diskon;
            $diskon['order_id'] = $order_id;
            $diskon_id = $this->orderDiskonRepo->save($diskon);
            $diskons[$i]->id = $diskon_id === 0 ? $diskon['id'] : $diskon_id;
        }
        if (count($diskons) > 0) {
            $this->orderDiskonRepo->removeNotInOrder($order_id, array_column((array)$diskons, 'id'));
        } else {
            $this->orderDiskonRepo->removeByOrder($order_id);
        }

        foreach ($additionals as $i => $biaya) {
            $biaya = (array)$biaya;
            $biaya['order_id'] = $order_id;
            $biaya_id = $this->orderBiayaLainRepo->save($biaya);
            $additionals[$i]->id = $biaya_id === 0 ? $biaya['id'] : $biaya_id;
        }
        if (count($additionals) > 0) {
            $this->orderBiayaLainRepo->removeNotInOrder($order_id, array_column((array)$additionals, 'id'));
        } else {
            $this->orderBiayaLainRepo->removeByOrder($order_id);
        }

        $totalBayar = 0;
        foreach ($pembayarans as $i => $pembayaran) {
            $pembayaran = (array)$pembayaran;
            $pembayaran['order_id'] = $order_id;
            $pembayaran_id = $this->orderPembayaranRepo->save($pembayaran);
            $pembayarans[$i]->id = $pembayaran_id === 0 ? $pembayaran['id'] : $pembayaran_id;
            $totalBayar += (int) $pembayaran['nominal'];
        }
        if (count($pembayarans) > 0) {
            $this->orderPembayaranRepo->removeNotInOrder($order_id, array_column((array)$pembayarans, 'id'));
        } else {
            $this->orderPembayaranRepo->removeByOrder($order_id);
        }

        $orderData['status_pembayaran'] = 'belum-bayar';
        $orderData['id'] = $order_id;
        if ($totalBayar === (int)$order->grandtotal) {
            $orderData['status_pembayaran'] = 'lunas';
        } else if ($totalBayar !== 0) {
            $orderData['status_pembayaran'] = 'cicilan';
        }
        $this->orderRepo->save($orderData);

        $db->transComplete();
        $response = [
        'status' => true,
        'message' => $message
        ];

        return $response;
    }

    public function removeData($data)
    {
        $data['is_active'] = false;
        $this->orderRepo->save($data);

        $response = [
        'status' => true,
        'message' => 'Data berhasil dihapus'
        ];

        return $response;
    }
}
