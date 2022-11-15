<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
  protected $table            = 'm_supplier';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
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
