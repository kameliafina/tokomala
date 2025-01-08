<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
PERALATAN DAPUR
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>
<div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">BARANG DIKEMAS</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('/pelangganctrl/barang_dikemas') ?>" class="d-none d-sm-inline-block btn btn-block custom-btn btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/barang.svg" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">BARANG DIKIRIM</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('adminctrl/laporan_dikirim') ?>" class="d-none d-sm-inline-block btn btn-block btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/barang.svg" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">BARANG DIKEMAS</h6>
            </div>
            <div class="card-body">
                <a href="<?= site_url('/adminctrl/laporan_dikemas') ?>" class="d-none d-sm-inline-block btn btn-block custom-btn btn-sm btn-primary shadow-sm">
                    <img src="<?php echo base_url('asset-admin') ?>/img/barang.svg" alt="Category Thumbnail"> </a>
            </div>
        </div>
    </div>
    

<?= $this->endSection('isi')?>