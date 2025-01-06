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
                <a href="<?= site_url('/adminctrl/list_user') ?>" class="d-none d-sm-inline-block btn btn-block custom-btn btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/pelanggan.svg" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DETAIL TRANSAKSI</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('adminctrl/addUserForm') ?>" class="d-none d-sm-inline-block btn btn-block btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/barang.svg" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>


<?= $this->endSection('form') ?>

