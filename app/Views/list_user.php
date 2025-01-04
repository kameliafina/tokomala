<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
BARANG
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a href="<?= site_url('/adminctrl/user_view') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
<img src="<?php echo base_url('asset-pelanggan') ?>/images/back.png" alt="Category Thumbnail"> Tambah Data</a>

<table class="table table-hover mt-3">
  <br>
  <thead>
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Id</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Dibuat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $nomor = 1;
    foreach ($datauser as $user) :
    ?>
    <th scope="row"><?= $nomor++;?></th>
      <td><?= $user['id']?></td>
      <td><?= $user['email']?></td>
      <td><?= $user['role']?></td>
      <td><?= $user['created_at']?></td>
      <td>
        <a href="" class="btn btn-danger btn-circle">
          <i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?= $this->endSection('form') ?>
