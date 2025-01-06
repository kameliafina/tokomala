<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranDetailModel extends Model
{
    protected $table = 'pembayaran_detail';  // Nama tabel
    protected $primaryKey = 'id';            // Kolom primary key
    protected $allowedFields = [
        'id_pembayaran', 
        'kd_barang', 
        'jumlah', 
        'subtotal'
    ];

}
