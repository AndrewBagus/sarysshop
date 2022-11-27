<?php

namespace App\Repositories\Pengiriman;

interface IPengirimanRepository
{
    public function getActive();
    public function getById($id);
    public function getByKurir($kurir_id);
    public function findByKurir($nama);
    public function save($data);
    public function removeByKurir($kurir_id);
}
