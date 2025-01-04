<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
BARANG
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
Tambah Data Barang

<div class="d-flex justify-content-end">
<a href="<?= site_url('barangctrl/databarang') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
<img src="<?php echo base_url('asset-pelanggan') ?>/images/back.png" alt="Category Thumbnail">Kembali</a>
</div>
<?= $this->endSection('isi') ?>

<?= $this->section('form') ?>

<?= form_open('/barangctrl/simpan', ['enctype' => 'multipart/form-data'])?>
<form>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Kode Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="kd_barang" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nama_barang">
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Kategori</label>
    <div class="col-sm-10">
        <select class="form-control" name="id_kat">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kat'] ?>"><?= $kat['nama_kat'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Harga Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="harga_barang">
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Stok Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="stok">
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Deskripsi</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="deskripsi"></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="foto">
    </div>
  </div>
  
  
  <button type="submit" class="btn btn-primary">Input </button>

</form>
<?= form_close(); ?>
<?= $this->endSection('form') ?>