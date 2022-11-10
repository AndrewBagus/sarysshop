<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelurahan extends Model
{
  protected $table            = 'm_kelurahan_desa';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama_propinsi',
    'nama_kabupaten_kota',
    'jenis_kabupaten_kota',
    'nama_kecamatan',
    'nama_kelurahan_desa',
    'kode_pos',
  ];
}
