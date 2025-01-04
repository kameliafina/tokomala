<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganCtrl extends BaseController
{
    public function index()
{
    // Hanya pelanggan yang dapat mengakses halaman ini
    if (session()->get('role') != 'customer') {
        return redirect()->to('/login');
    }    

    return view('main/layout3');
}

}
