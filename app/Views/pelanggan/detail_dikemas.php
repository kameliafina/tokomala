<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
BARANG DIKEMAS
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>
<h1>Detail Transaksi</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Kode Barang</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($detailtransaksi)): ?>
            <?php foreach ($detailtransaksi as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= $row['kd_barang']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Tidak ada detail untuk transaksi ini.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection('isi')?>