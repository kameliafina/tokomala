<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginCtrl extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verifikasi kredensial pengguna
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

if ($user && password_verify($password, $user['password'])) {
    log_message('debug', 'Role from database: ' . $user['role']); // Cek role yang diambil dari DB

    session()->set([
        'user_id' => $user['id'],
        'email' => $user['email'],
        'role' => $user['role']
    ]);


            

            if ($user['role'] == 'admin') {
                return redirect()->to('/adminctrl/index');
            } else {
                return redirect()->to('/pelangganctrl/index');
            }
            
        } else {
            // Jika login gagal
            return redirect()->to('/login')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    //membuat akun baru yang otomatis jadi role pelanggan
    public function registerForm()
    {
    return view('register');
}

public function registerSubmit()
{
    // Ambil data input dari formulir
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    // Validasi input
    if (!$email || !$password || !$confirmPassword) {
        return redirect()->to('/register')->with('error', 'Semua field wajib diisi!');
    }

    if ($password !== $confirmPassword) {
        return redirect()->to('/register')->with('error', 'Password tidak cocok!');
    }

    // Simpan user baru dengan role 'customer'
    $userModel = new UserModel();
    $userModel->save([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password
        'role' => 'customer'
    ]);

    // Redirect ke halaman login
    return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}


}
