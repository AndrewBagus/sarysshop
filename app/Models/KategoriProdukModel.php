<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
  protected $table            = 'm_kategori_produk';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
