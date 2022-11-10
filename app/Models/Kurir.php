<?php

namespace App\Models;

use CodeIgniter\Model;

class Kurir extends Model
{
  protected $table            = 'm_kurir';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'kategori',
    'image',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
