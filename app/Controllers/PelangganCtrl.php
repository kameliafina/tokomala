<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganCtrl extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu.');
        }

        return view('dashboard');
    }

    public function profile()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu.');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session('user_id'));

        return view('pelanggan/profile', ['user' => $user]);
    }

public function databarang()
    {
        $barang = new BarangModel();
        $ambil = $barang->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'databarang' => $ambil
        ];
        return view('pelanggan/dapur', $data);
    }

    

}
