<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPelanggan extends Model
{
  protected $table            = 'm_kategori_pelanggan';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
