<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
PERALATAN DAPUR
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>

<?php foreach ($databarang as $barang) : ?>
                    <div class="col">
                      <div class="product-item">
                        <span class="badge bg-success position-absolute m-3">-30%</span>
                        
                        <figure>
                          <a href="/pelangganctrl/detail/<?= $barang['kd_barang']?>" title="Product Title">
                          <img src="<?= base_url('upload/' . $barang['foto']) ?>" alt="<?= $barang['nama_barang'] ?>" class="tab-i">
                          </a>
                        </figure>
                        <h3><?= $barang['nama_barang']?></h3>
                        <h3><?= $barang['kd_barang']?></h3>
                        <span class="qty"><?= $barang['stok']?> unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                        <span class="price"><?= $barang['harga_barang']?></span>
                      
                        
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
                    <?php endforeach ?>

<?= $this->endSection('isi')?>