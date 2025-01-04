<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'kd_barang', 'jumlah', 'created_at'];

    public function getKeranjangByUser($userId)
    {
        return $this->select('keranjang.*, barang.nama_barang, barang.harga_barang, barang.foto')
                    ->join('barang', 'keranjang.kd_barang = barang.kd_barang')
                    ->where('keranjang.user_id', $userId)
                    ->findAll();
    }
}
