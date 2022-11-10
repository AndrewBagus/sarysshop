<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetail extends Model
{
  protected $table            = 't_order_detail';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'order_id',
    'produk_varian_id',
    'qty',
    'harga',
    'berat',
    'diskon_persen',
    'diskon_nominal',
    'subtotal',
    'modal_barang',
  ];
}
