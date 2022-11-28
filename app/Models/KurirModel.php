<?php

namespace App\Models;

use CodeIgniter\Model;

class KurirModel extends Model
{
    protected $table            = 'm_kurir';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
    'nama',
    'image',
    'kategori',
    'eta_awal',
    'eta_akhir',
    'is_active',
    'created_by',
    'updated_at'
    ];
}
