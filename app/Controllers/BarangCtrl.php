<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
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

        // var_dump($ambil);
        // die();

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
        $this->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]'
        ]);

        //untuk upload foto
        $foto = $this->request->getFile('foto');
        $namafoto = $foto->getRandomName(); //memberikan nama random difile foto
        $foto->move('upload', $namafoto); //memindah file foto ke dalam folder uploads
        
        $barang ->insert([
            'kd_barang' => $this->request->getVar('kd_barang'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'id_kat' => $this->request->getVar('id_kat'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namafoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');

        return redirect()->to('barangctrl/databarang');
    }
}
