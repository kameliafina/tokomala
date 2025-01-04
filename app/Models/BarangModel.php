<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'kd_barang';
    protected $allowedFields    = ['nama_barang', 'harga_barang', 'stok', 'deskripsi', 'foto', 'id_kat'];
}
