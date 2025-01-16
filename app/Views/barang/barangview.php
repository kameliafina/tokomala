<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
BARANG
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a href="<?= site_url('/barangctrl/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
<img src="<?php echo base_url('asset-pelanggan') ?>/images/plus.png" alt="Category Thumbnail"> Tambah Data</a>

<table class="table table-hover mt-3">
  <br>
  <thead>
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Id Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Kategori</th>
      <th scope="col">Harga Satuan</th>
      <th scope="col">Stok</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Foto</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $nomor = 1;
    foreach ($databarang as $barang) :
    ?>
    <th scope="row"><?= $nomor++;?></th>
      <td><?= $barang['kd_barang']?></td>
      <td><?= $barang['nama_barang']?></td>
      <td><?= $barang['id_kat']?></td>
      <td><?= $barang['harga_barang']?></td>
      <td><?= $barang['stok']?></td>
      <td><?= $barang['deskripsi']?></td>
      <td>
        <img src="<?= base_url('upload/' . $barang['foto']) ?>" alt="<?= $barang['nama_barang'] ?>" width="100" height="auto">
      </td>
      <td>
      <a href="<?= site_url('barangctrl/hapusbarang/' . $barang['kd_barang']) ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
        <i class="fas fa-trash"></i></a>
        <a href="<?= site_url('barangctrl/editbarang/' . $barang['kd_barang']) ?>" class="btn btn-success btn-circle">
          <i class="fas fa-edit"></i></a>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?= $this->endSection('form') ?>
