<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table            = 'm_pengiriman';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
    'nama',
    'kurir_id',
    'is_active',
    'created_by',
    'updated_at'
    ];
}
