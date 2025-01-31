<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
TRANSAKSI
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<?= $this->endSection('isi') ?>

<?= $this->section('form') ?>

<div class="row">


    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PROSES TRANSAKSI</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('/adminctrl/histori_list') ?>" class="d-none d-sm-inline-block btn btn-block custom-btn btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/transaksi.png" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DETAIL BARANG DITERIMA</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('/adminctrl/histori_diterima') ?>" class="d-none d-sm-inline-block btn btn-block btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/diterima.png" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR BARANG DIKIRIM</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('/adminctrl/histori_dikirim') ?>" class="d-none d-sm-inline-block btn btn-block custom-btn btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/mobil.png" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>


<?= $this->endSection('form') ?>

