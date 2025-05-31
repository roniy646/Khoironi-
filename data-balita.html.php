<?php
include "koneksi.php";
// Ambil data balita dari database
$sql = "SELECT * FROM balita ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/1.css">
    <title>Data Balita</title>
</head>
<body>
    <div class="navbar">
        <img src="img/logo.png" alt="Logo Posyandu" class="logo" />
        <a href="index.html.php">Beranda</a>
        <a href="profil.html.php">Profil</a>
        <a href="layanan.html.php">Layanan</a>
        <a href="pendaftaran.html.php">Pendaftaran Balita</a>
        <a href="data-balita.html.php" class="active">Data Balita</a>
        <a href="transaksi.html.php">Transaksi</a>
        <a href="data-transaksi.html.php">Data Transaksi</a>
    </div>
    <div class="main-content">
        <div class="container">
            <section>
                <h2 class="text-center">Data Balita Terdaftar</h2>
                <table class="tabel-transaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Balita</th>
                            <th>Tanggal Lahir</th>
                            <th>Nama Orang Tua</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Berat Badan (kg)</th>
                            <th>Tinggi Badan (cm)</th>
                            <th>IMT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php $no=1; while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row["nama"]) ?></td>
                                <td><?= htmlspecialchars($row["tanggal_lahir"]) ?></td>
                                <td><?= htmlspecialchars($row["orang_tua"]) ?></td>
                                <td><?= htmlspecialchars($row["alamat"]) ?></td>
                                <td><?= htmlspecialchars($row["jenis_kelamin"]) ?></td>
                                <td><?= htmlspecialchars($row["berat_badan"]) ?></td>
                                <td><?= htmlspecialchars($row["tinggi_badan"]) ?></td>
                                <td><?= htmlspecialchars($row["imt"]) ?></td>
                            </tr>
                            <?php } ?>
                        <?php else: ?>
                            <tr><td colspan="9" style="text-align:center;">Belum ada data balita yang terdaftar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>