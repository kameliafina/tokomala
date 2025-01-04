<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
BARANG
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
Tambah Data Barang

<div class="d-flex justify-content-end">
    <a href="<?= site_url('adminctrl/user_view') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <img src="<?= base_url('asset-pelanggan/images/back.png') ?>" alt="Category Thumbnail"> Kembali
    </a>
</div>
<?= $this->endSection('isi') ?>

<?= $this->section('form') ?>
<form action="/adminctrl/addUser" method="post">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" required>
        </div>
    </div>
  
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" required>
        </div>
    </div>
  
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <select name="role" required class="form-control">
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>
        </div>
    </div>
  
    <button type="submit" class="btn btn-primary">Input</button>
</form>
<?= $this->endSection('form') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
