<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
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
        return view('pelanggan/barang', $data);
    }

    public function barangByKategori($id_kat)
{
    $barangModel = new BarangModel();
    $kategoriModel = new KategoriModel();

    // Ambil barang berdasarkan kategori
    $databarang = $barangModel->where('id_kat', $id_kat)->findAll();

    // Ambil nama kategori
    $kategori = $kategoriModel->find($id_kat);

    $data = [
        'databarang' => $databarang,
        'nama_kategori' => $kategori['nama_kat'] ?? 'Kategori Tidak Ditemukan'
    ];

    return view('pelanggan/barang', $data);
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
        $keranjang = $this->keranjangModel->findAll();
        $totalHarga = 0;

        foreach ($keranjang as &$item) {
            $barang = $this->barangModel->where('kd_barang', $item['kd_barang'])->first();

            if ($barang) {
                $totalHarga += $barang['harga_barang'] * $item['jumlah'];
                $item['foto'] = $barang['foto'];
                $item['nama_barang'] = $barang['nama_barang'];
                $item['harga_barang'] = $barang['harga_barang'];
            } else {
                $item['foto'] = 'default.jpg';
                $item['nama_barang'] = 'Barang tidak ditemukan';
                $item['harga_barang'] = 0;
            }
        }

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
    $namaPelanggan = $this->request->getPost('nama_pelanggan'); // Nama pelanggan dari form
    $alamat = $this->request->getPost('alamat'); // Alamat dari form

    // Ambil file bukti
    $fileBukti = $this->request->getFile('bukti');
    $buktiName = '';

    // Validasi dan pindahkan file jika ada
    if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
        $buktiName = $fileBukti->getRandomName();
        $fileBukti->move(FCPATH . 'upload', $buktiName);
    } else {
        return redirect()->back()->with('error', 'Harap unggah bukti pembayaran yang valid.');
    }

    // Simpan data transaksi utama
    $transaksiModel = new TransaksiModel();
    $dataTransaksi = [
        'user_id' => $idPelanggan,
        'total_harga_barang' => $totalHargaBarang,
        'biaya_pengiriman' => $biayaPengiriman,
        'total_bayar' => $totalKeseluruhan,
        'id_pengiriman' => $idPengiriman,
        'bukti' => $buktiName,
        'status' => 'dikemas',
        'nama_pelanggan' => $namaPelanggan,  // Menyimpan nama pelanggan
        'alamat' => $alamat,  // Menyimpan alamat
        'created_at' => date('Y-m-d H:i:s')
    ];
    $transaksiModel->save($dataTransaksi);

    // Ambil ID transaksi terakhir
    $idTransaksi = $transaksiModel->getInsertID();

    // Ambil data keranjang pengguna
    $keranjangModel = new KeranjangModel();
    $keranjang = $keranjangModel->getKeranjangByUser($idPelanggan);

    // Simpan data ke tabel pembayaran_detail
    $pembayaranDetailModel = new PembayaranDetailModel();
    foreach ($keranjang as $item) {
        $pembayaranDetailModel->save([
            'id_pembayaran' => $idTransaksi,
            'kd_barang' => $item['kd_barang'],
            'jumlah' => $item['jumlah'],
            'subtotal' => $item['jumlah'] * $item['harga_barang']
        ]);
    }

    // Hapus data keranjang setelah pembayaran berhasil
    $keranjangModel->where('user_id', $idPelanggan)->delete();

    return redirect()->to('/pelangganctrl/suksesPembayaran')->with('success', 'Pembayaran berhasil dilakukan.');
}




public function pembayaran()
{
    $keranjang = $this->keranjangModel->findAll();
    $totalHarga = 0;

    foreach ($keranjang as &$item) {
        $barang = $this->barangModel->where('kd_barang', $item['kd_barang'])->first();

        if ($barang) {
            $totalHarga += $barang['harga_barang'] * $item['jumlah'];
            $item['foto'] = $barang['foto'];
            $item['nama_barang'] = $barang['nama_barang'];
            $item['harga_barang'] = $barang['harga_barang'];
        } else {
            $item['foto'] = 'default.jpg';
            $item['nama_barang'] = 'Barang tidak ditemukan';
            $item['harga_barang'] = 0;
        }
    }

    $pengirimanModel = new \App\Models\PengirimanModel();
    $pengiriman = $pengirimanModel->findAll();

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

    public function lacak()
    {
        return view('pelanggan/lacak');
    }

    public function barang_dikemas()
{
    // Pastikan pengguna sudah login
    if (!session()->has('user_id')) {
        return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu.');
    }

    $userId = session()->get('user_id'); // Ambil ID user dari session
    $transaksiModel = new TransaksiModel();

    // Ambil data transaksi dengan status "dikemas" dan user_id sesuai
    $ambil = $transaksiModel->where('status', 'dikemas')
                            ->where('user_id', $userId)
                            ->findAll();

    $data = [
        'datatransaksi' => $ambil
    ];

    return view('pelanggan/barang_dikemas', $data);
}


public function detail_dikemas($id)
{
    $transaksi = new TransaksiModel();

    // Gabungkan data dari `transaksi`, `pembayaran_detail`, `barang`, dan `pengiriman`
    $detail = $transaksi
        ->select('transaksi.*, 
                  pembayaran_detail.kd_barang, 
                  pembayaran_detail.jumlah, 
                  pembayaran_detail.subtotal, 
                  barang.nama_barang, 
                  barang.foto, 
                  pengiriman.jasa_pengiriman, 
                  pengiriman.biaya_pengiriman')
        ->join('pembayaran_detail', 'pembayaran_detail.id_pembayaran = transaksi.id')
        ->join('barang', 'barang.kd_barang = pembayaran_detail.kd_barang') 
        ->join('pengiriman', 'pengiriman.id = transaksi.id_pengiriman') // Join ke tabel pengiriman
        ->where('transaksi.id', $id)
        ->findAll();

    $data = [
        'detailtransaksi' => $detail
    ];

    return view('pelanggan/detail_dikemas', $data);
}

public function barang_dikirim()
{
    // Pastikan pengguna sudah login
    if (!session()->has('user_id')) {
        return redirect()->to('/login')->with('error', 'Harap login terlebih dahulu.');
    }

    $userId = session()->get('user_id'); // Ambil ID user dari session
    $transaksiModel = new TransaksiModel();

    // Ambil data transaksi dengan status "dikemas" dan user_id sesuai
    $ambil = $transaksiModel->where('status', 'dikirim')
                            ->where('user_id', $userId)
                            ->findAll();

    $data = [
        'datatransaksi' => $ambil
    ];

    return view('pelanggan/barang_dikirim', $data);
}


public function detail_dikirim($id)
{
    $transaksi = new TransaksiModel();

    // Gabungkan data dari `transaksi`, `pembayaran_detail`, `barang`, dan `pengiriman`
    $detail = $transaksi
        ->select('transaksi.*, 
                  pembayaran_detail.kd_barang, 
                  pembayaran_detail.jumlah, 
                  pembayaran_detail.subtotal, 
                  barang.nama_barang, 
                  barang.foto, 
                  pengiriman.jasa_pengiriman, 
                  pengiriman.biaya_pengiriman')
        ->join('pembayaran_detail', 'pembayaran_detail.id_pembayaran = transaksi.id')
        ->join('barang', 'barang.kd_barang = pembayaran_detail.kd_barang') 
        ->join('pengiriman', 'pengiriman.id = transaksi.id_pengiriman') // Join ke tabel pengiriman
        ->where('transaksi.id', $id)
        ->findAll();

    $data = [
        'detailtransaksi' => $detail
    ];

    return view('pelanggan/detail_dikirim', $data);
}

public function updateStatus($id)
{
    $transaksi = new TransaksiModel();

    // Update status transaksi menjadi 'diterima'
    $transaksi->update($id, ['status' => 'diterima']);

    // Redirect kembali ke halaman barang dikirim
    return redirect()->to('/pelangganctrl/barang_dikirim')->with('success', 'Status berhasil diperbarui menjadi Diterima');
}




}
