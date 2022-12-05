<?php

namespace App\Repositories\ProdukVarian;

use App\Models\ProdukVarianModel;

class ProdukVarianRepository implements IProdukVarianRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new ProdukVarianModel();
    }

    public function getByProduk($produk_id)
    {
        return $this->model->select('id, produk_id, code, warna, ukuran, berat, image, harga_beli, stok')
            ->where(
                [
                'produk_id' => $produk_id,
                'is_active' => true
                ]
            );
    }

    public function checkCode($id, $code)
    {
        return $this->model->where(
            [
            'id !=' => $id,
            'code' => $code
            ]
        );
    }

    public function getById($id)
    {
        return $this->model->where('id', $id);
    }

    public function getByOrder($order_id)
    {
        $tbl = 'm_produk_varian';
        return $this->model
            ->join('m_produk p', 'p.id = ' . $tbl . '.produk_id')
            ->join('m_kategori_produk kp', 'p.kategori_produk_id = ' . 'kp.id')
            ->join('m_jenis_produk jp', 'p.jenis_produk_id = jp.id')
            ->join('t_order_detail od', 'm_produk_varian.id = od.produk_varian_id')
            ->where($tbl . '.is_active', true)
            ->where('p.is_active', true)
            ->where('od.order_id', $order_id)
            ->select(
                $tbl . '.id, ' .
                $tbl . '.produk_id, ' .
                $tbl . '.warna, ' .
                $tbl . '.berat, ' .
                $tbl . '.ukuran, ' .
                $tbl . '.image, ' .
                $tbl . '.stok, 
                od.harga,
                od.qty,
                od.berat,
                od.diskon_tipe,
                od.diskon_persen,
                od.diskon_nominal,
                ((od.harga * od.qty) - od.diskon_nominal) as subtotal,
                p.nama as produk_nama,
                p.image as produk_image,
                jp.id as jenis_produk_id,
                jp.nama as jenis_produk,
                kp.nama as kategori,
                CONCAT(' . $tbl . '.ukuran, " ", ' . $tbl . '.warna) as deskripsi,
                CONCAT(jp.nama, " ", p.tempo_kedatangan, " hari") as keterangan'
            )
            ->get()
            ->getResult();
    }

    public function findByProduk($search)
    {
        $tbl = 'm_produk_varian';
        return $this->model
            ->join('m_produk p', 'p.id = ' . $tbl . '.produk_id')
            ->join('m_kategori_produk kp', 'p.kategori_produk_id = ' . 'kp.id')
            ->join('m_jenis_produk jp', 'p.jenis_produk_id = jp.id')
            ->where($tbl . '.is_active', true)
            ->where('p.is_active', true)
            ->groupStart()
            ->like('p.nama', $search)
            ->orLike($tbl . '.warna', $search)
            ->orLike($tbl . '.ukuran', $search)
            ->orLike('jp.nama', $search)
            ->orLike('kp.nama', $search)
            ->orLike('CONCAT(p.nama, " ", ' . $tbl . '.ukuran, " ", ' . $tbl . '.warna)', $search)
            ->groupEnd()
            ->select(
                $tbl . '.id, ' .
                $tbl . '.produk_id, ' .
                $tbl . '.warna, ' .
                $tbl . '.berat, ' .
                $tbl . '.ukuran, ' .
                $tbl . '.image, ' .
                $tbl . '.stok, 
                p.nama as produk_nama,
                p.image as produk_image,
                jp.id as jenis_produk_id,
                jp.nama as jenis_produk,
                kp.nama as kategori,
                CONCAT(' . $tbl . '.ukuran, " ", ' . $tbl . '.warna) as deskripsi,
                CONCAT(jp.nama, " ", p.tempo_kedatangan, " hari") as keterangan'
            )
            ->get()
            ->getResult();
    }

    public function save($data)
    {
        $this->model->save($data);
        return $this->model->getInsertID();
    }

    public function removeByProduk($produk_id)
    {
        return $this->model
            ->where('produk_id', $produk_id)
            ->set('is_active', false)
            ->update();
    }
}
