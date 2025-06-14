<?php
include "koneksi.php";

$sql = "SELECT t.id, b.nama, t.jenis_transaksi, t.jumlah, t.tanggal, t.keterangan
        FROM transaksi t
        JOIN balita b ON t.id_balita = b.id
        ORDER BY t.tanggal DESC, t.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styel.css">
</head>

<body class="app-body">
    <div class="app-root">
        <nav class="app-navbar">
            <img src="img/logo.png" alt="Logo Posyandu" class="app-logo" />
            <a href="index.html.php">Beranda</a>
            <a href="pendaftaran.html.php">Pendaftaran Balita</a>
            <a href="data-balita.html.php">Data Balita</a>
            <a href="transaksi.html.php">Transaksi</a>
            <a href="data-transaksi.html.php" class="active">Data Transaksi</a>
        </nav>
        <div class="app-main-content">
            <div class="container app-container py-4">
                <h2 class="text-center mb-4">Data Transaksi</h2>
                <div class="mb-3 text-end">
                    <a href="transaksi.html.php" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah Transaksi
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Balita</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php $no = 1;
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row["nama"]) ?></td>
                                        <td><?= htmlspecialchars($row["jenis_transaksi"]) ?></td>
                                        <td><?= htmlspecialchars($row["jumlah"]) ?></td>
                                        <td><?= htmlspecialchars($row["tanggal"]) ?></td>
                                        <td><?= htmlspecialchars($row["keterangan"]) ?></td>
                                        <td>
                                            <a href="hapus-transaksi.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                               title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus transaksi ini?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <a href="edit-transaksi.php?id=<?= urlencode($row['id']) ?>" class="btn btn-warning btn-sm"
                                               title="Edit Transaksi">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data transaksi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
