<?= $this->extend('main/layout2') ?>

<?= $this->section('judul') ?>
BAYAR BELANJA
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<table>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($keranjang as $item): ?>
            <tr>
                <td><?= $item['nama_barang']; ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td><?= number_format($item['harga_barang'], 0, ',', '.'); ?></td>
                <td class="subtotal"><?= number_format($item['harga_barang'] * $item['jumlah'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h4>Total Harga Barang: <span id="totalHarga"><?= number_format($totalHarga, 0, ',', '.'); ?></span></h4>

<h3>Pilih Jasa Pengiriman</h3>
<form method="post" action="/pelangganctrl/prosespembayaran" enctype="multipart/form-data">
    <input type="hidden" name="total_harga_barang" value="<?= $totalHarga; ?>" id="totalHargaBarang">
    <input type="hidden" name="biaya_pengiriman" value="0" id="biayaPengiriman">
    <input type="hidden" name="total_bayar" value="<?= $totalHarga; ?>" id="totalBayar">
    <input type="hidden" name="id_pelanggan" value="<?= session()->get('user_id'); ?>">

    <!-- Input untuk Nama Pelanggan dan Alamat -->
    <div>
        <label for="nama_pelanggan">Nama Pelanggan:</label>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?= session()->get('user_name'); ?>" required />
    </div>
    
    <div>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?= old('alamat'); ?></textarea>
    </div>

    <!-- Pilih Jasa Pengiriman -->
    <h3>Pilih Jasa Pengiriman</h3>
    <select name="jasa_pengiriman" id="jasaPengiriman" required>
        <option value="">-- Pilih Jasa Pengiriman --</option>
        <?php foreach ($pengiriman as $pengirimanItem): ?>
            <option value="<?= $pengirimanItem['id']; ?>" data-biaya="<?= $pengirimanItem['biaya_pengiriman']; ?>">
                <?= $pengirimanItem['jasa_pengiriman']; ?> - Rp <?= number_format($pengirimanItem['biaya_pengiriman'], 0, ',', '.'); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h4>Biaya Pengiriman: <span id="biayaPengirimanText">Rp 0</span></h4>
    <h4>Total Pembayaran: <span id="totalPembayaran">Rp <?= number_format($totalHarga, 0, ',', '.'); ?></span></h4>
    <input type="file" name="bukti" id="bukti" required />

    <button type="submit">Lanjutkan Pembayaran</button>
</form>


<script>
    document.getElementById('jasaPengiriman').addEventListener('change', function () {
        var biayaPengiriman = parseInt(this.options[this.selectedIndex].getAttribute('data-biaya'));
        document.getElementById('biayaPengiriman').value = biayaPengiriman;
        document.getElementById('biayaPengirimanText').textContent = 'Rp ' + biayaPengiriman.toLocaleString();

        var totalHargaBarang = parseInt(document.getElementById('totalHarga').textContent.replace(/\D/g, ''));
        var totalBayar = totalHargaBarang + biayaPengiriman;

        document.getElementById('totalBayar').value = totalBayar;
        document.getElementById('totalPembayaran').textContent = 'Rp ' + totalBayar.toLocaleString();
    });
</script>

<?= $this->endSection('isi') ?>
