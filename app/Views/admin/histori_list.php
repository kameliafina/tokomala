<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
PROSES TRANSAKSI
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a href="<?= site_url('/adminctrl/histori_view') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
<img src="<?php echo base_url('asset-pelanggan') ?>/images/back.png" alt="Category Thumbnail">Kembali</a>

<table class="table table-hover mt-3">
  <br>
  <thead>
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Id Transaksi</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">Biaya Pengiriman</th>
      <th scope="col">Alamat</th>
      <th scope="col">Total Harga Barang</th>
      <th scope="col">Total Bayar</th>
      <th scope="col">Bukti</th>
      <th scope="col">Status</th>
      <th scope="col">Tanggal</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $nomor = 1;
    foreach ($datatransaksi as $user) :
    ?>
    <th scope="row"><?= $nomor++;?></th>
      <td><?= $user['id']?></td>
      <td><?= $user['nama_pelanggan']?></td>
      <td><?= $user['biaya_pengiriman']?></td>
      <td><?= $user['alamat']?></td>
      <td><?= $user['total_harga_barang']?></td>
      <td><?= $user['total_bayar']?></td>
      <td>
        <img src="<?= base_url('upload/' . $user['bukti']) ?>" alt="<?= $user['nama_pelanggan'] ?>" width="100" height="auto">
      </td>
      <td>
        <form action="<?= site_url('/adminctrl/updateStatus/' . $user['id']) ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" class="btn btn-success btn-circle" <?= ($user['status'] == 'dikirim') ? 'disabled' : '' ?>>
            <i class="fas fa-check"></i>
        </button>
    </form>
  </td>

      <td><?= $user['created_at']?></td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?= $this->endSection('form') ?>
