<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
PERALATAN DAPUR
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan</title>
</head>
<body>
    <h1>Profil Anda</h1>
    <p>Email: <?= esc($user['email']) ?></p>
    <p>Role: <?= esc($user['role']) ?></p>
    <a href="<?= site_url('/pelangganctrl/index') ?>">Kembali ke Home</a>
</body>
</html>
<?= $this->endSection('isi')?>