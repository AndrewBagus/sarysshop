<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisProdukModel extends Model
{
  protected $table            = 'm_jenis_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
