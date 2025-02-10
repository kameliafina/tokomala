<head>
    <link href="<?php echo base_url('asset-tambahan') ?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">
                <div class="px-5 ms-xl-4">
                    <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                    <a href="<?php echo base_url('home/tampil') ?>">
                    <img src="<?php echo base_url('asset-pelanggan') ?>/images/logo2.png" alt="logo" class="img-fluid">
                    </a>
                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                    <form action="/register" method="post" style="width: 23rem;">
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">BUAT AKUN</h3>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="email" required class="form-control form-control-lg" />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="password" required class="form-control form-control-lg" />
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="confirm_password" required class="form-control form-control-lg" />
                            <label class="form-label" for="confirm_password">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="<?php echo base_url('asset-pelanggan') ?>/images/logo2.png" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Akun Berhasil Dibuat!',
            text: 'Silakan login untuk melanjutkan.',
            showConfirmButton: true
        }).then(() => {
            window.location.href = "<?= base_url('login'); ?>"; // Redirect ke halaman login setelah sukses
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Registrasi Gagal!',
            text: '<?= session()->getFlashdata('error'); ?>',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

</section>





<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
