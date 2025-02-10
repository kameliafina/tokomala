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
    
        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/login')->with('error', 'Format email tidak valid!');
        }
    
        // Validasi password: harus kombinasi angka dan huruf
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
            return redirect()->to('/login')->with('error', 'Password harus kombinasi huruf dan angka!');
        }
    
        // Verifikasi kredensial pengguna
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
    
        if ($user && password_verify($password, $user['password'])) {
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
            return redirect()->to('/login')->with('error', 'Email atau Password salah!');
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
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $confirm_password = $this->request->getPost('confirm_password');

    // Validasi email harus format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return redirect()->to('/register')->with('error', 'Format email tidak valid!');
    }

    // Validasi password: harus kombinasi huruf dan angka, minimal 6 karakter
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
        return redirect()->to('/register')->with('error', 'Password harus minimal 6 karakter dan kombinasi huruf serta angka!');
    }

    // Validasi kecocokan password
    if ($password !== $confirm_password) {
        return redirect()->to('/register')->with('error', 'Password dan Konfirmasi Password tidak cocok!');
    }

    $userModel = new \App\Models\UserModel();
    $existingUser = $userModel->where('email', $email)->first();

    if ($existingUser) {
        return redirect()->to('/register')->with('error', 'Email sudah digunakan, coba email lain.');
    }

    $userModel->insert([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    return redirect()->to('/register')->with('success', 'Akun berhasil dibuat! Silakan login.');
}





}
