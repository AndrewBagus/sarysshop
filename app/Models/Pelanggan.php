<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan extends Model
{
  protected $table            = 'm_pelanggan';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'kategori_pelanggan_id',
    'kelurahan_id',
    'name',
    'code',
    'kode_pos',
    'no_telpon',
    'email',
    'alamat',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
