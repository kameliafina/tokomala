<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Id Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Biaya Pengiriman</th>
                <th>Alamat</th>
                <th>Total Harga Barang</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1;
            foreach ($datatransaksi as $user) :
            ?>
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $user['id']; ?></td>
                <td><?= $user['nama_pelanggan']; ?></td>
                <td><?= $user['biaya_pengiriman']; ?></td>
                <td><?= $user['alamat']; ?></td>
                <td><?= $user['total_harga_barang']; ?></td>
                <td><?= $user['total_bayar']; ?></td>
                <td><?= $user['status']; ?></td>
                <td><?= $user['created_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
