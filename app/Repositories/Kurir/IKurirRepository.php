<?php

namespace App\Repositories\Kurir;

interface IKurirRepository
{
    public function getActive();
    public function getById($id);
    public function save($data);
}
