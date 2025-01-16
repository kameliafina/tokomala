<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Edit Barang
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<?= form_open_multipart('barangctrl/updatebarang') ?>
    <input type="hidden" name="kd_barang" value="<?= $row['kd_barang'] ?>">

    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= esc($row['nama_barang']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="id_kat" class="form-label">Kategori</label>
        <select class="form-select" id="id_kat" name="id_kat" required>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kat'] ?>" <?= $kat['id_kat'] == $row['id_kat'] ? 'selected' : '' ?>>
                    <?= esc($kat['nama_kat']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="harga_barang" class="form-label">Harga Barang</label>
        <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="<?= esc($row['harga_barang']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="stok" class="form-label">Stok Barang</label>
        <input type="text" class="form-control" id="stok" name="stok" value="<?= esc($row['stok']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= esc($row['deskripsi']) ?></textarea>
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto Barang</label>
        <input type="file" class="form-control" id="foto" name="foto">
        <?php if ($row['foto']): ?>
            <img src="<?= base_url('upload/' . $row['foto']) ?>" alt="<?= esc($row['nama_barang']) ?>" width="150">
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
<?= form_close() ?>


<?= $this->endSection('isi') ?>
