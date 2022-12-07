<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 't_order';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
    'pelanggan_id',
    'pelanggan_kirim',
    'order_status_id',
    'user_id',
    'kurir_id',
    'code',
    'tanggal_order',
    'tanggal_dikirim',
    'tanggal_diterima',
    'estimasi_pengiriman',
    'note',
    'subtotal_pembelian',
    'no_resi',
    'biaya_kurir',
    'total_berat',
    'total_diskon',
    'grandtotal',
    'total_modal_barang',
    'status_pembayaran',
    'cancel_date',
    'cancel_note',
    'is_active',
    'created_by',
    'updated_at',
    'updated_by',
    ];
}
