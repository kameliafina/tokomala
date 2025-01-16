<?php

namespace App\Models;

use CodeIgniter\Model;

class KritikModel extends Model
{
    protected $table            = 'kirsar';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'deskripsi'];

}
