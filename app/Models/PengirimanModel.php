<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table      = 'pengiriman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jasa_pengiriman', 'biaya_pengiriman'];

}
