<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  protected $table            = 'm_user';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'role_id',
    'email',
    'phone',
    'password',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
