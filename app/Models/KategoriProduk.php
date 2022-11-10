<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProduk extends Model
{
  protected $table            = 'm_kategori_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
