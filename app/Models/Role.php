<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
  protected $table            = 'm_role';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'description',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
