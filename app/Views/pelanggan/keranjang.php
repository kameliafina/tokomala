<?= $this->extend('main/layout2') ?>

<?= $this->section('judul') ?>
KERANJANG BELANJA
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table class="table">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($keranjang)) : ?>
            <?php foreach ($keranjang as $item) : ?>
                <tr>
                    <td><img src="<?= base_url('upload/' . $item['foto']) ?>" width="50"></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= number_format($item['harga_barang'], 0, ',', '.') ?></td>
                    <td>
                        <form action="<?= base_url('/pelangganctrl/ubahjumlah/' . $item['id']) ?>" method="POST">
                            <button type="submit" name="action" value="kurang" class="btn btn-warning btn-sm">-</button>
                            <span><?= $item['jumlah'] ?></span>
                            <button type="submit" name="action" value="tambah" class="btn btn-success btn-sm">+</button>
                        </form>
                    </td>
                    <td>
                        <a href="<?= base_url('/pelangganctrl/hapuskeranjang/' . $item['id']) ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">Keranjang Anda kosong.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Menampilkan total harga -->
<?php if (!empty($keranjang)) : ?>
    <div class="mt-3">
        <h3>Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h3>
    </div>
<?php endif; ?>

<a href="<?= base_url('/pelangganctrl/pembayaran/') ?>" class="btn btn-danger">Bayar</a>

<?= $this->endSection('isi') ?>