<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'kd_barang';
    protected $allowedFields    = ['nama_barang', 'harga_barang', 'stok', 'deskripsi', 'foto', 'id_kat'];

    public function getBarangWithKategori($id_kat = null)
{
    $query = $this->select('barang.*, kategori.nama_kat')
                  ->join('kategori', 'kategori.id_kat = barang.id_kat');
    
    if ($id_kat) {
        $query->where('barang.id_kat', $id_kat);
    }
    
    return $query->findAll();
}

}
