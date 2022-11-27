<?php

namespace App\Services\Kurir;

interface IKurirService
{
    public function getDataTable($request);
    public function findLayanans($request);
    public function getLayanans($request);
    public function saveData($request);
    public function removeData($request);
}
