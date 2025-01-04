<form action="/loginctrl/loginSubmit" method="post" style="width: 23rem;">
    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

    <div class="form-outline mb-4">
        <input type="email" name="email" required class="form-control form-control-lg" />
        <label class="form-label" for="email">Email</label>
    </div>

    <div class="form-outline mb-4">
        <input type="password" name="password" required class="form-control form-control-lg" />
        <label class="form-label" for="password">Password</label>
    </div>

    <div class="pt-1 mb-4">
        <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
    </div>
</form>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-end">
<a href="<?= site_url('home/tampil') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
<img src="<?php echo base_url('asset-pelanggan') ?>/images/back.png" alt="Category Thumbnail">Kembali</a>
</div>
