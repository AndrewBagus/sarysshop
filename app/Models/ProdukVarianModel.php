<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukVarianModel extends Model
{
  protected $table            = 'm_produk_varian';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'produk_id',
    'code',
    'warn',
    'ukuran',
    'berat',
    'satuan',
    'harga_beli',
    'stok',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
