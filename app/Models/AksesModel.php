<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model
{
  protected $table            = 't_akses';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'user_id',
    'feature_id',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
