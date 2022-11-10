<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
  protected $table            = 'm_supplier';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'code',
    'kelurahan_id',
    'kode_pos',
    'no_telpon',
    'email',
    'alamat',
    'is_active',
    'created_by',
    'update_at',
    'updated_by',
  ];
}
