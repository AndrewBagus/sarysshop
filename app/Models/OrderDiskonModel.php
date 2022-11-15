<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDiskonModel extends Model
{
  protected $table            = 't_order_diskon';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'order_id',
    'nama',
    'tipe_diskon',
    'diskon_persen',
    'diskon_nominal'
  ];
}
