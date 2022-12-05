<?php

namespace App\Repositories\Pelanggan;

use App\Models\PelangganModel;

class PelangganRepository implements IPelangganRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new PelangganModel();
    }

    private function getPelanggan()
    {
        return $this->model
            ->join('m_kategori_pelanggan kp', 'm_pelanggan.kategori_pelanggan_id = kp.id', 'left')
            ->join('m_kelurahan_desa kb', 'm_pelanggan.kelurahan_id = kb.id', 'left')
            ->select("m_pelanggan.*, kp.nama as kategori_pelanggan , CONCAT(kb.nama_kecamatan, ', ', kb.jenis_kabupaten_kota, ' ', kb.nama_kabupaten_kota, ', ', kb.nama_propinsi) AS kecamatan, kb.kode_pos, kp.is_default")
            ->where('m_pelanggan.is_active', true);
    }

    public function getActive()
    {
        return $this->getPelanggan();
    }

    public function getById($id)
    {
        return $this->getPelanggan()
            ->where('m_pelanggan.id', $id)
            ->get()
            ->getRow();
    }

    public function findPelanggans($search)
    {
        return $this->getPelanggan()
            ->like('m_pelanggan.nama', $search)
            ->get()
            ->getResult();
    }

    public function save($data)
    {
        return $this->model->save($data);
    }
}
