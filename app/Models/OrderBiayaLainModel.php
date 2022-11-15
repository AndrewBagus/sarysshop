<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderBiayaLainModel extends Model
{
  protected $table            = 't_order_biaya_lain';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'order_id',
    'nama',
    'tipe_biaya',
    'biaya_persen',
    'biaya_nominal'
  ];
}
