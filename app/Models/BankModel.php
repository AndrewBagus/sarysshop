<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
  protected $table            = 'm_bank';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'jenis_bank_id',
    'no_rekening',
    'atas_nama',
    'nama',
    'code',
    'image',
    'atas_nama',
    'created_by',
    'updated_at'
  ];
}
