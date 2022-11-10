<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDiskon extends Model
{
  protected $table            = 't_order_diskon';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'order_id',
    'name',
    'tipe_diskon',
    'diskon_persen',
    'diskon_nominal'
  ];
}
