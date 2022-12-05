<?php

namespace App\Repositories\OrderBiayaLain;

interface IOrderBiayaLainRepository
{
    public function getByOrder($order_id);
    public function save($data);
    public function removeByOrder($order_id);
    public function removeNotInOrder($order_id, $diskons);
}
