<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
BARANG DIKEMAS
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>
<table class="table table-hover mt-3">
  <br>
  <thead>
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Id Transaksi</th>
      <th scope="col">Id User</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">Total Bayar</th>
      <th scope="col">Status</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $nomor = 1;
    foreach ($datatransaksi as $user) :
    ?>
    <th scope="row"><?= $nomor++;?></th>
      <td><?= $user['id']?></td>
      <td><?= $user['user_id']?></td>
      <td><?= $user['nama_pelanggan']?></td>
      <td><?= $user['total_bayar']?></td>
      <td><?= $user['status']?></td>
      <td><?= $user['created_at']?></td>
      <td>
      <a href="<?= site_url('/pelangganctrl/detail_dikemas/'. $user['id']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Detail</a>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?= $this->endSection('isi')?>