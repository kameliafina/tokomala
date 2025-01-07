<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KeranjangModel;
use App\Models\PembayaranDetailModel;
use App\Models\PengirimanModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
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

public function prosesPembayaran()
{
    // Ambil data dari form
    $idPengiriman = $this->request->getPost('jasa_pengiriman');
    $totalHargaBarang = $this->request->getPost('total_harga_barang');
    $biayaPengiriman = $this->request->getPost('biaya_pengiriman');
    $totalKeseluruhan = $totalHargaBarang + $biayaPengiriman;
    $idPelanggan = session()->get('user_id');

    // Ambil file bukti
    $fileBukti = $this->request->getFile('bukti');
    $buktiName = '';

    // Validasi dan pindahkan file jika ada
    if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
        $buktiName = $fileBukti->getRandomName();

        // Pindahkan file ke folder public/upload
        $fileBukti->move(FCPATH . 'upload', $buktiName);

        // Debugging untuk memastikan file tersimpan
        if (!file_exists(FCPATH . 'upload/' . $buktiName)) {
            return redirect()->back()->with('error', 'File tidak tersimpan di folder public/upload.');
        }
    } else {
        return redirect()->back()->with('error', 'Harap unggah bukti pembayaran yang valid.');
    }

    // Simpan data transaksi
    $transaksiModel = new TransaksiModel();
    $dataTransaksi = [
        'user_id' => $idPelanggan,
        'total_harga_barang' => $totalHargaBarang,
        'biaya_pengiriman' => $biayaPengiriman,
        'total_bayar' => $totalKeseluruhan,
        'id_pengiriman' => $idPengiriman,
        'bukti' => $buktiName,
        'status' => 'dikemas',
        'created_at' => date('Y-m-d H:i:s')
    ];
    $transaksiModel->save($dataTransaksi);

    return redirect()->to('/pelangganctrl/suksesPembayaran');
}


public function pembayaran()
{
    // Ambil data keranjang dari model
    $keranjangModel = new KeranjangModel();
    $keranjang = $keranjangModel->findAll();

    // Inisialisasi total harga
    $totalHarga = 0;

    // Ambil model barang
    $barangModel = new BarangModel();

    // Iterasi untuk menghitung total harga dan menambahkan data barang ke data keranjang
    foreach ($keranjang as &$item) {
        // Ambil harga barang berdasarkan ID
        $barang = $barangModel->find($item['kd_barang']);
        if ($barang) {
            $totalHarga += $barang['harga_barang'] * $item['jumlah']; // Total harga = harga barang * jumlah
            $item['foto'] = $barang['foto'];  
            $item['nama_barang'] = $barang['nama_barang'];  
            $item['harga_barang'] = $barang['harga_barang'];  
        }
    }

    // Ambil data jasa pengiriman
    $pengirimanModel = new PengirimanModel();
    $pengiriman = $pengirimanModel->findAll(); // Ambil semua jasa pengiriman

    // Pass data keranjang, total harga, dan pengiriman ke view
    return view('pelanggan/pembayaran', [
        'keranjang' => $keranjang,
        'totalHarga' => $totalHarga,
        'pengiriman' => $pengiriman
    ]);
}

public function pembayaranSukses()
{
    return view('pelanggan/sukses');
}

}
