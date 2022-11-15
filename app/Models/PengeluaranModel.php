<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
  protected $table            = 't_pengeluaran';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'date',
    'biaya',
    'jumlah',
    'total',
    'keterangan',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
  ];
}
