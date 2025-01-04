<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminCtrl extends BaseController
{
    public function index()
    {
        // Pastikan hanya admin yang dapat mengakses halaman ini
        if (!session()->has('user_id') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        return view('main/layout');
    }

    public function addUserForm()
    {
        // Pastikan hanya admin yang dapat mengakses
        if (!session()->has('user_id') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        return view('add_user'); // Menampilkan form tambah user
    }

    public function addUser()
    {
        // Validasi input
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        if (!$email || !$password || !$role) {
            return redirect()->to('/adminctrl/addUserForm')->with('error', 'Semua field wajib diisi!');
        }

        // Simpan user baru
        $userModel = new UserModel();
        $userModel->save([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Enkripsi password
            'role' => $role
        ]);

        return redirect()->to('/adminctrl/index')->with('success', 'User berhasil ditambahkan!');
    }

    public function user_view()
    {
        return view('userview');
    }

    public function list_user()
    {
        $user = new UserModel();
        $ambil = $user->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datauser' => $ambil
        ];
        return view('list_user', $data);
    }
}



