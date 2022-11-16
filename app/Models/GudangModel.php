<?php

namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
  protected $table            = 'm_gudang';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'kelurahan_id',
    'kode_pos',
    'telp',
    'alamat',
    'admin',
    'is_active',
    'created_by',
    'update_at',
    'updated_by',
  ];
}
