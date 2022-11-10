<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderPembayaran extends Model
{
  protected $table            = 't_order_pembayaran';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'order_id',
    'bank_id',
    'jenis_pembayaran',
    'tanggal_pembayaran',
    'nominal'
  ];
}
