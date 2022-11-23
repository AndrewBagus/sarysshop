<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
  protected $table            = 'm_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'kategori_produk_id',
    'jenis_produk_id',
    'supplier_id',
    'gudang_id',
    'nama',
    'keterangan',
    'image',
    'tempo_kedatangan',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
  ];
}
