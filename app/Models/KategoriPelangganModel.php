<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPelangganModel extends Model
{
  protected $table            = 'm_kategori_pelanggan';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
