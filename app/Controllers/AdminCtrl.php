<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

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

        return redirect()->to('/adminctrl/user_view')->with('success', 'User berhasil ditambahkan!');
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

    public function histori_view()
    {
        return view('admin/historiview');
    }

    public function histori_list()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'dikemas')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/histori_list', $data);
    }

    public function histori_dikirim()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'dikirim')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/histori_dikirim', $data);
    }

    public function histori_diterima()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'diterima')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/histori_diterima', $data);
    }

    public function updateStatus($id)
{
    // Cek apakah transaksi dengan ID ini ada
    $transaksiModel = new TransaksiModel();
    $transaksi = $transaksiModel->find($id);

    if ($transaksi) {
        // Update status transaksi menjadi 'dikirim'
        $transaksiModel->update($id, [
            'status' => 'dikirim'
        ]);

        // Redirect kembali ke halaman histori dengan pesan sukses
        return redirect()->to('/adminctrl/histori_view')->with('success', 'Status transaksi berhasil diperbarui menjadi Dikirim');
    } else {
        // Jika transaksi tidak ditemukan, redirect dengan pesan error
        return redirect()->to('/adminctrl/histori_view')->with('error', 'Transaksi tidak ditemukan');
    }
}

public function laporan()
{
    return view('admin/laporan');
}

public function laporan_dikemas()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'dikemas')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/laporan_dikemas', $data);
    }

    public function laporan_dikirim()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'dikirim')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/laporan_dikirim', $data);
    }

    public function laporan_diterima()
    {
        $transaksi = new TransaksiModel();
        $ambil = $transaksi->where('status', 'diterima')->findAll();

        // var_dump($ambil);
        // die();

        $data = [
            'datatransaksi' => $ambil
        ];
        return view('admin/laporan_diterima', $data);
    }



public function print_laporan()
{
    // Ambil data transaksi dari model
    $transaksiModel = new TransaksiModel();
    $transaksi = $transaksiModel->where('status', 'dikemas')->findAll(); // Contoh filter berdasarkan status 'dikirim'

    // Load view untuk laporan
    $html = view('admin/laporan_pdf', ['datatransaksi' => $transaksi]);

    // Inisialisasi Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (first pass)
    $dompdf->render();

    // Stream PDF to browser
    return $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => 0]);
}

public function print_laporan2()
{
    // Ambil data transaksi dari model
    $transaksiModel = new TransaksiModel();
    $transaksi = $transaksiModel->where('status', 'dikirim')->findAll(); // Contoh filter berdasarkan status 'dikirim'

    // Load view untuk laporan
    $html = view('admin/laporan_pdf', ['datatransaksi' => $transaksi]);

    // Inisialisasi Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (first pass)
    $dompdf->render();

    // Stream PDF to browser
    return $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => 0]);
}

public function print_laporan3()
{
    // Ambil data transaksi dari model
    $transaksiModel = new TransaksiModel();
    $transaksi = $transaksiModel->where('status', 'diterima')->findAll(); // Contoh filter berdasarkan status 'dikirim'

    // Load view untuk laporan
    $html = view('admin/laporan_pdf', ['datatransaksi' => $transaksi]);

    // Inisialisasi Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (first pass)
    $dompdf->render();

    // Stream PDF to browser
    return $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => 0]);
}

    

}



