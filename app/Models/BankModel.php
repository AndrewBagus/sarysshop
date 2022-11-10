<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
  protected $table            = 'm_bank';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'no_rekening',
    'atas_nama',
    'name',
    'code',
    'image',
    'atas_nama',
    'created_by',
    'updated_at'
  ];
}
