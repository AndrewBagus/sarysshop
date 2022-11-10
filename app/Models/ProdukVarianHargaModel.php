<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukVarianHargaModel extends Model
{
  protected $table            = 'm_produk_varian_harga';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'produk_varian_id',
    'kategori_pelanggan_id',
    'harga',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
  ];
}
