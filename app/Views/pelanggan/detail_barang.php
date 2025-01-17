<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
DETAIL BARANG

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="<?= base_url('upload/' . $barang['foto']) ?>" alt="<?= $barang['nama_barang'] ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= $barang['nama_barang'] ?></h2>
            <p>Kode Barang: <?= $barang['kd_barang'] ?></p>
            <p>Harga: Rp. <?= number_format($barang['harga_barang'], 0, ',', '.') ?></p>
            <p>Stok: <?= $barang['stok'] ?> Unit</p>
            <p>Deskripsi: <?= $barang['deskripsi'] ?></p>
            
            <!-- button tambah keranjang -->
            <?php if (session()->has('user_id')) : ?>
    <!-- Form tambah ke keranjang untuk pengguna yang sudah login -->
    <form action="<?= base_url('pelangganctrl/tambahkeranjang') ?>" method="post">
        <input type="hidden" name="kd_barang" id="kd_barang" value="<?= $barang['kd_barang'] ?>">
        <button type="submit" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></button>
    </form>
<?php else : ?>
    <!-- Tombol untuk pengguna yang belum login -->
    <a href="<?= base_url('/login') ?>" class="btn btn-warning">Login untuk menambah ke keranjang</a>
<?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>


<?= $this->endSection('isi')?>