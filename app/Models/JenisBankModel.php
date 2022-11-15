<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisBankModel extends Model
{
  protected $table            = 'm_jenis_bank';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'image',
    'description',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
