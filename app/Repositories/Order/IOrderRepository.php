<?php

namespace App\Repositories\Order;

interface IOrderRepository
{
    public function countAll();
    public function getActive();
    public function getById($id);
    public function save($data);
}
