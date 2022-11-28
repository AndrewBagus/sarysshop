<?php

namespace App\Repositories\ProdukVarianHarga;

use App\Models\ProdukVarianHargaModel;
use Config\Database;

class ProdukVarianHargaRepository implements IProdukVarianHargaRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new ProdukVarianHargaModel();
    }

    public function getByProduk($produk_id)
    {
        $table = 'm_produk_varian_harga';
        return $this->model
            ->join('m_produk_varian pv', $table . '.produk_varian_id = pv.id')
            ->select($table . '.*')
            ->where('pv.produk_id', $produk_id);
    }

    public function getById($id)
    {
        return $this->model->where('id', $id);
    }

    public function getByVarian($varian_id)
    {
        return $this->model->where(
            [
            'produk_varian_id' => $varian_id,
            'is_active' => true
            ]
        );
    }

    public function getInVarians($varians)
    {
        $table = 'm_produk_varian_harga';
        return $this->model
            ->join('m_kategori_pelanggan kp', $table . '.kategori_pelanggan_id = kp.id', 'right')
            ->whereIn($table . '.produk_varian_id', $varians)
            ->orWhere('kp.is_active', true)
            ->select($table . '.id, ' . $table . '.harga, ' . $table . '.produk_varian_id, kp.id as pelanggan_id, kp.nama, kp.is_default');
    }

    public function getByVarianKategoriPelanggan($varian_id, $kategori_pelanggan_id)
    {
        return $this->model->where(
            [
            'produk_varian_id' => $varian_id,
            'kategori_pelanggan_id' => $kategori_pelanggan_id,
            'is_active' => true
            ]
        );
    }

    public function save($data)
    {
        return $this->model->save($data);
    }

    public function removeByProduk($hargas)
    {
        return $this->model
            ->whereIn('id', $hargas)
            ->set('is_active', false)
            ->update();
    }
}
