<?php

namespace App\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
  protected $table            = 'm_feature';
  protected $primaryKey       = 'id';
  protected $allowedFields    = [
    'nama',
    'link',
    'parent',
    'icon',
    'order',
    'is_active',
    'created_by',
    'updated_at'
  ];
}
