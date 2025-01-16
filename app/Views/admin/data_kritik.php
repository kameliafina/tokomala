<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
KRITIK DAN SARAN
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<table class="table table-hover mt-3">
  <br>
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nama</th>
      <th scope="col">Kritik dan Saran</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($datakritik as $kritik) :
    ?>
      <td><?= $kritik['id']?></td>
      <td><?= $kritik['nama']?></td>
      <td><?= $kritik['deskripsi']?></td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
<?= $this->endSection('form') ?>
