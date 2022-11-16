<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table            = 'm_user';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'role_id',
    'nama',
    'email',
    'telp',
    'password',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
