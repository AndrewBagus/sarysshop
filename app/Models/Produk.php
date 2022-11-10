<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
  protected $table            = 'm_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'kategori_produk_id',
    'jenis_produk_id',
    'supplier_id',
    'name',
    'keterangan',
    'image',
    'tempo_kedatangan',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
  ];
}
