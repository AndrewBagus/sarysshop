<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
  protected $table            = 'm_pelanggan';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'kategori_pelanggan_id',
    'kelurahan_id',
    'nama',
    'code',
    'kode_pos',
    'telp',
    'email',
    'alamat',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
