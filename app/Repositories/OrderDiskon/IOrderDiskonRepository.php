<?php

namespace App\Repositories\OrderDiskon;

interface IOrderDiskonRepository
{
    public function getByOrder($order_id);
    public function save($data);
    public function removeByOrder($order_id);
    public function removeNotInOrder($order_id, $diskons);
}
