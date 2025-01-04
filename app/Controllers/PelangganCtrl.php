<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KeranjangModel;
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
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu.');
        }
    
        $barang = new BarangModel();
        $ambil = $barang->findAll();
    
        $data = [
            'databarang' => $ambil
        ];
        return view('pelanggan/dapur', $data);
    }
    

    protected $keranjangModel;
    protected $barangModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->barangModel = new BarangModel();
    }

    // Menambah barang ke keranjang
    public function tambahKeranjang()
{
    // Pastikan pengguna sudah login
    if (!session()->has('user_id')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userId = session()->get('user_id');
    $kdBarang = $this->request->getPost('kd_barang');

    // Validasi kode barang
    $barang = $this->barangModel->find($kdBarang);
    if (!$barang) {
        return redirect()->back()->with('error', 'Barang tidak ditemukan.');
    }

    // Periksa apakah barang sudah ada di keranjang
    $keranjang = $this->keranjangModel
                      ->where('user_id', $userId)
                      ->where('kd_barang', $kdBarang)
                      ->first();

    if ($keranjang) {
        // Jika barang sudah ada, tambahkan jumlahnya
        $this->keranjangModel->update($keranjang['id'], [
            'jumlah' => $keranjang['jumlah'] + 1
        ]);
    } else {
        // Jika barang belum ada, tambahkan barang baru
        $this->keranjangModel->save([
            'user_id' => $userId,
            'kd_barang' => $kdBarang,
            'jumlah' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
}


    // Menampilkan isi keranjang
    public function keranjang()
{
    // Ambil data keranjang dari model
    $keranjangModel = new KeranjangModel();
    $keranjang = $keranjangModel->findAll();

    // Inisialisasi total harga
    $totalHarga = 0;

    // Ambil model barang
    $barangModel = new BarangModel();

    // Iterasi untuk menghitung total harga dan menambahkan foto barang ke data keranjang
    foreach ($keranjang as &$item) {
        // Ambil harga barang berdasarkan ID
        $barang = $barangModel->find($item['kd_barang']);
        if ($barang) {
            $totalHarga += $barang['harga_barang'] * $item['jumlah']; // Total harga = harga barang * jumlah
            $item['foto'] = $barang['foto'];  // Menambahkan foto barang ke item
            $item['nama_barang'] = $barang['nama_barang'];  // Menambahkan foto barang ke item
            $item['harga_barang'] = $barang['harga_barang'];  // Menambahkan foto barang ke item
        }
    }

    // Pass data keranjang dan total harga ke view
    return view('pelanggan/keranjang', [
        'keranjang' => $keranjang,
        'totalHarga' => $totalHarga
    ]);
}



    // Menghapus barang dari keranjang
    public function hapusKeranjang($id)
    {
        $this->keranjangModel->delete($id);
        return redirect()->to('/pelangganctrl/keranjang')->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function ubahjumlah($id)
{
    $action = $this->request->getPost('action');

    // Pastikan aksi yang diterima adalah 'tambah' atau 'kurang'
    if ($action != 'tambah' && $action != 'kurang') {
        return redirect()->back()->with('error', 'Aksi tidak valid!');
    }

    // Ambil model keranjang dan data keranjang berdasarkan ID
    $keranjangModel = new KeranjangModel();
    $keranjang = $keranjangModel->find($id);

    if ($keranjang) {
        // Tentukan jumlah yang baru berdasarkan aksi
        if ($action == 'tambah') {
            $newJumlah = $keranjang['jumlah'] + 1; // Tambah jumlah
        } elseif ($action == 'kurang' && $keranjang['jumlah'] > 1) {
            $newJumlah = $keranjang['jumlah'] - 1; // Kurangi jumlah (minimal 1)
        } else {
            return redirect()->back()->with('error', 'Jumlah tidak bisa kurang dari 1.');
        }

        // Update jumlah barang
        $keranjangModel->update($id, ['jumlah' => $newJumlah]);

        return redirect()->to('pelangganctrl/keranjang')->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    return redirect()->to('pelangganctrl/keranjang')->with('error', 'Barang tidak ditemukan.');
}


}


