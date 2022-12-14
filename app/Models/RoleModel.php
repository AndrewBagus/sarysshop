<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
  protected $table            = 'm_role';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'description',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
