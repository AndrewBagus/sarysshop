<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderStatus extends Model
{
  protected $table            = 'm_order_status';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'code',
    'name',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
