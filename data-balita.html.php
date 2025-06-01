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
    <title>Data Balita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom App CSS (OPTIONAL, jika ingin custom style) -->
    <link rel="stylesheet" href="css/1.css">
</head>
<body class="app-body">
    <div class="app-root">
        <nav class="app-navbar">
            <img src="img/logo.png" alt="Logo Posyandu" class="app-logo" />
            <a href="index.html.php">Beranda</a>
            <a href="layanan.html.php">Layanan</a>
            <a href="pendaftaran.html.php">Pendaftaran Balita</a>
            <a href="data-balita.html.php" class="active">Data Balita</a>
            <a href="transaksi.html.php">Transaksi</a>
            <a href="data-transaksi.html.php">Data Transaksi</a>
        </nav>
        <div class="app-main-content">
            <div class="container app-container py-4">
                <section>
                    <h2 class="text-center mb-4">Data Balita Terdaftar</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-primary">
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
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data balita yang terdaftar.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>