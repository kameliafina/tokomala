<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
Peralatan <?= $nama_kategori ?>
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>

<!-- Cek Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error') ?>',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

<div class="row">
    <?php foreach ($databarang as $barang) : ?>
        <div class="col">
            <div class="product-item">
                <figure>
                    <a href="/pelangganctrl/detail/<?= $barang['kd_barang']?>" title="Product Title">
                        <img src="<?= base_url('upload/' . $barang['foto']) ?>" alt="<?= $barang['nama_barang'] ?>" class="tab-i">
                    </a>
                </figure>
                <h3><?= $barang['nama_barang']?></h3>
                <h3><?= $barang['kd_barang']?></h3>
                <span class="qty"><?= $barang['stok']?> unit</span>
                <span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                <span class="price"><?= $barang['harga_barang']?></span>

                <!-- Cek jika stok habis -->
                <?php if ($barang['stok'] <= 0): ?>
                    <button class="btn btn-danger" disabled>Stok Habis</button>
                <?php else: ?>
                    <?php if (session()->has('user_id')) : ?>
                        <!-- Form tambah ke keranjang -->
                        <form action="<?= base_url('pelangganctrl/tambahkeranjang') ?>" method="post">
                            <input type="hidden" name="kd_barang" id="kd_barang" value="<?= $barang['kd_barang'] ?>">
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                    <?php else : ?>
                        <!-- Tombol untuk pengguna yang belum login -->
                        <a href="<?= base_url('/login') ?>" class="btn btn-warning">Login untuk menambah ke keranjang</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection('isi')?>
