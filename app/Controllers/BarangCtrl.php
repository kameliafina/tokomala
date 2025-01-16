<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\KritikModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangCtrl extends BaseController
{
    public function index()
    {
        return view('barang/barangview');
    }

    public function databarang()
    {
        $barang = new BarangModel();
        $ambil = $barang->findAll();

        $data = [
            'databarang' => $ambil
        ];
        return view('barang/barangview', $data);
    }

    public function tambah()
    {
        helper('form');
        $kategoriModel = new KategoriModel;
        $data['kategori'] = $kategoriModel->findAll();

        return view('barang/tambahbarang', $data);
    }

    public function simpan()
    {
        $barang = new BarangModel();

        //validasi
        if (!$this->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Upload foto
        $foto = $this->request->getFile('foto');
        $namafoto = $foto->getRandomName();
        $foto->move('upload', $namafoto);
        
        $barang->insert([
            'kd_barang' => $this->request->getVar('kd_barang'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'id_kat' => $this->request->getVar('id_kat'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namafoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');

        return redirect()->to(site_url('barangctrl/databarang'));
    }

    public function editbarang($kd_barang)
    {
        helper('form');
        $barang = new BarangModel();
        $kategori = new KategoriModel();

        $data = [
            'row' => $barang->find($kd_barang),
            'kategori' => $kategori->findAll()
        ];

        return view('barang/editbarang', $data);
    }

    public function updatebarang()
{
    helper('form'); // Pastikan helper form sudah di-load
    $barang = new BarangModel();

    // Validasi input
    if (!$this->validate([
        'nama_barang' => 'required',
        'harga_barang' => 'required|numeric',
        'stok' => 'required|numeric',
        'deskripsi' => 'required',
        'foto' => 'if_exist|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
    ])) {
        // Redirect kembali dengan pesan error
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Ambil data dari request
    $kd_barang = $this->request->getVar('kd_barang');
    $foto = $this->request->getFile('foto');
    $data = [
        'nama_barang' => $this->request->getVar('nama_barang'),
        'id_kat' => $this->request->getVar('id_kat'),
        'harga_barang' => $this->request->getVar('harga_barang'),
        'stok' => $this->request->getVar('stok'),
        'deskripsi' => $this->request->getVar('deskripsi'),
    ];

    // Jika ada file foto yang diunggah, proses penggantian foto
    if ($foto && $foto->isValid()) {
        $namafoto = $foto->getRandomName();
        $foto->move('upload', $namafoto);
        $data['foto'] = $namafoto;

        // Hapus foto lama
        $barangLama = $barang->find($kd_barang);
        if ($barangLama && file_exists('upload/' . $barangLama['foto'])) {
            unlink('upload/' . $barangLama['foto']);
        }
    }

    // Update data di database
    $update = $barang->update($kd_barang, $data);

    if ($update) {
        session()->setFlashdata('pesan', 'Data berhasil diupdate');
    } else {
        session()->setFlashdata('pesan', 'Gagal mengupdate data');
    }

    return redirect()->to('/barangctrl/databarang');
}

public function hapusbarang($kd_barang)
{
    $barang = new BarangModel();

    // Cari data barang berdasarkan kode barang
    $barangLama = $barang->find($kd_barang);

    if (!$barangLama) {
        session()->setFlashdata('error', 'Data tidak ditemukan');
        return redirect()->to('/barangctrl/databarang');
    }

    // Hapus file foto jika ada
    if ($barangLama['foto'] && file_exists('upload/' . $barangLama['foto'])) {
        unlink('upload/' . $barangLama['foto']);
    }

    // Hapus data dari database
    $barang->delete($kd_barang);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->to('/barangctrl/databarang');
}

public function datakritik()
    {
        $kritik = new KritikModel();
        $ambil = $kritik->findAll();

        $data = [
            'datakritik' => $ambil
        ];
        return view('admin/data_kritik', $data);
    }

    public function tambahkritik()
    {
        helper('form');
        return view('main/layout2');
    }

    public function simpankritik()
    {
        $kritik = new KritikModel();

        // Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Simpan data ke database
        $kritik->insert([
            'nama' => $this->request->getVar('nama'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ]);

        session()->setFlashdata('pesan', 'Kritik berhasil dikirim');
        return redirect()->to(base_url('home/tampil'));
    }

}
