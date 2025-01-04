<h3>Registrasi Pelanggan Baru</h3>
<form action="/register" method="post" style="width: 25rem;">
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" required class="form-control form-control-lg" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
        <input type="password" name="password" required class="form-control form-control-lg" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="confirm_password">Konfirmasi Password</label>
        <input type="password" name="confirm_password" required class="form-control form-control-lg" />
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">Daftar</button>
</form>

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
