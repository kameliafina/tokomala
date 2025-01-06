<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id','id_pengiriman', 'nama_pelanggan', 'alamat',
        'biaya_pengiriman', 'total_harga_barang','bukti', 'status', 'total_bayar', 'created_at'
    ];
}
