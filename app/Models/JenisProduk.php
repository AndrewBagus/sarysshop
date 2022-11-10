<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisProduk extends Model
{
  protected $table            = 'm_jenis_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
