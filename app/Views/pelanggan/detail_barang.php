<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
DETAIL BARANG
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url('upload/' . $barang['foto']) ?>" alt="<?= $barang['nama_barang'] ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= $barang['nama_barang'] ?></h2>
            <p>Kode Barang: <?= $barang['kd_barang'] ?></p>
            <p>Harga: <?= number_format($barang['harga_barang'], 0, ',', '.') ?> IDR</p>
            <p>Stok: <?= $barang['stok'] ?> Unit</p>
            <p>Deskripsi: <?= $barang['deskripsi'] ?></p>

            <div class="d-flex align-items-center justify-content-between mt-4">
                <div class="input-group product-qty">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                            <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                        </button>
                    </span>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                            <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                        </button>
                    </span>
                </div>
            </div>

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
<?= $this->endSection('isi')?>