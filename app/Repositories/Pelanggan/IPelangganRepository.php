<?php

namespace App\Repositories\Pelanggan;

interface IPelangganRepository
{
    public function getActive();
    public function getById($id);
    public function findPelanggans($search);
    public function save($data);
}
