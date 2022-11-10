<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukVarianImageModel extends Model
{
  protected $table            = 'm_produk_varian_image';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'produk_varian_id',
    'image',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
  ];
}
