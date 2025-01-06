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
    $idPengiriman = $this->request->getPost('jasa_pengiriman');  // id dari pengiriman
    $totalHargaBarang = $this->request->getPost('total_harga_barang');
    $biayaPengiriman = $this->request->getPost('biaya_pengiriman');
    $totalKeseluruhan = $totalHargaBarang + $biayaPengiriman;
    $idPelanggan = session()->get('user_id'); // ID pelanggan yang login

    // Mengambil file bukti
    $fileBukti = $this->request->getFile('bukti');
    $buktiName = '';
    
    // Cek apakah ada file yang diupload
    if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
        // Berikan nama file yang unik
        $buktiName = $fileBukti->getRandomName();
        
        // Pindahkan file ke folder yang diinginkan
        $fileBukti->move(WRITEPATH . 'uploads', $buktiName);
    }

    // Verifikasi apakah id_pengiriman ada di tabel pengiriman
    $pengirimanModel = new PengirimanModel();
    $pengiriman = $pengirimanModel->find($idPengiriman);

    if (!$pengiriman) {
        return redirect()->back()->with('error', 'Jasa pengiriman tidak ditemukan.');
    }

    // Simpan data transaksi ke tabel transaksi
    $transaksiModel = new TransaksiModel();
    $dataTransaksi = [
        'user_id' => $idPelanggan,  // menggunakan user_id sesuai dengan yang ada di tabel
        'total_harga_barang' => $totalHargaBarang,
        'biaya_pengiriman' => $biayaPengiriman,
        'total_bayar' => $totalKeseluruhan,
        'id_pengiriman' => $idPengiriman, // Menggunakan id dari tabel pengiriman
        'bukti' => $buktiName,  // Menyimpan nama file bukti yang diupload
        'status' => 'dikemas',   // Status otomatis 'dikemas'
        'created_at' => date('Y-m-d H:i:s')
    ];
    $transaksiModel->save($dataTransaksi);

    // Mendapatkan ID transaksi yang baru disimpan
    $idTransaksi = $transaksiModel->getInsertID();

    // Simpan detail keranjang ke tabel pembayaran_detail
    $keranjangModel = new KeranjangModel();
    $keranjang = $keranjangModel->where('user_id', $idPelanggan)->findAll();

    $pembayaranDetailModel = new PembayaranDetailModel();
    $barangModel = new BarangModel();
    
    foreach ($keranjang as $item) {
        // Cek apakah barang ditemukan
        $barang = $barangModel->find($item['kd_barang']);
        
        if ($barang) {
            // Simpan detail pembayaran
            $detailPembayaran = [
                'id_pembayaran' => $idTransaksi,
                'kd_barang' => $item['kd_barang'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $barang['harga_barang'] * $item['jumlah'] // Pastikan harga_barang ada
            ];
            $pembayaranDetailModel->save($detailPembayaran);

            // Mengurangi stok barang
            $barangModel->update($barang['kd_barang'], [
                'stok' => $barang['stok'] - $item['jumlah']
            ]);
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    }

    // Hapus data keranjang setelah pembayaran berhasil
    $keranjangModel->where('user_id', $idPelanggan)->delete();

    return redirect()->to('/pelangganctrl/suksesPembayaran'); // Halaman sukses pembayaran
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
