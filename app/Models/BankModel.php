<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
  protected $table            = 'm_bank';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'jenis_bank_id',
    'rekening',
    'atas_nama',
    'cabang',
    'code',
    'image',
    'atas_nama',
    'created_by',
    'updated_at'
  ];
}
