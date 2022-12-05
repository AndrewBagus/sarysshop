<?php

namespace App\Repositories\ProdukVarian;

interface IProdukVarianRepository
{
    public function getById($id);
    public function checkCode($id, $code);
    public function getByOrder($order_id);
    public function getByProduk($produk_id);
    public function findByProduk($search);
    public function save($data);
    public function removeByProduk($produk_id);
}
