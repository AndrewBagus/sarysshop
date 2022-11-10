<?php

namespace App\Models;

use CodeIgniter\Model;

class Feature extends Model
{
  protected $table            = 'm_feature';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'name',
    'link',
    'parent',
    'icon',
    'order',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
