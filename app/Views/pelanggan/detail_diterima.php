<?= $this->extend('main/layout2')?>

<?= $this->section('judul')?>
BARANG DIKEMAS
<?= $this->endSection('judul')?>

<?= $this->section('isi')?>
<h1>Detail Pelanggan</h1>
<p><strong>Nama Pelanggan :</strong> <?= $detailtransaksi[0]['nama_pelanggan']; ?>
<br>
<strong>Alamat :</strong> <?= $detailtransaksi[0]['alamat']; ?>
<br>
<strong>Jasa Pengiriman :</strong> <?= $detailtransaksi[0]['jasa_pengiriman']; ?> - <?= $detailtransaksi[0]['biaya_pengiriman']; ?> 
<br>
<strong>Total Harga Barang :</strong> <?= $detailtransaksi[0]['total_harga_barang']; ?>
<br>
<strong>Total Pembelian :</strong> <?= $detailtransaksi[0]['total_bayar']; ?>
</p>

<h2>Detail Barang</h2>
<table cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Barang</th> <!-- Kolom Nama Barang -->
            <th>Gambar Barang</th> <!-- Kolom Gambar Barang -->
            <th>Jumlah</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($detailtransaksi)): ?>
            <?php foreach ($detailtransaksi as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama_barang']; ?></td> <!-- Menampilkan Nama Barang -->
                    <td>
                        <!-- Menampilkan gambar barang, pastikan file foto ada -->
                        <img src="<?= base_url('upload/' . $row['foto']); ?>" alt="<?= $row['nama_barang']; ?>" width="100">
                    </td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Tidak ada detail untuk transaksi ini.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection('isi')?>
