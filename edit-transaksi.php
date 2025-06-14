<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM transaksi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $transaksi = $result->fetch_assoc();

    if (!$transaksi) {
        echo "Data transaksi tidak ditemukan!";
        exit;
    }
} else {
    echo "ID transaksi tidak ditemukan!";
    exit;
}

$balita_list = $conn->query("SELECT id, nama FROM balita");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_balita = $_POST["id_balita"];
    $jenis_transaksi = $_POST["jenis_transaksi"];
    $jumlah = $_POST["jumlah"];
    $tanggal = $_POST["tanggal"];
    $keterangan = $_POST["keterangan"];

    $update = "UPDATE transaksi SET id_balita=?, jenis_transaksi=?, jumlah=?, tanggal=?, keterangan=? WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("isissi", $id_balita, $jenis_transaksi, $jumlah, $tanggal, $keterangan, $id);

    if ($stmt->execute()) {
        header("Location: data-transaksi.html.php");
        exit;
    } else {
        echo "Gagal memperbarui data transaksi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Edit Transaksi</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Balita</label>
                <select name="id_balita" class="form-select" required>
                    <?php while($balita = $balita_list->fetch_assoc()): ?>
                        <option value="<?= $balita['id'] ?>" <?= $balita['id'] == $transaksi['id_balita'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($balita['nama']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Jenis Transaksi</label>
                <select name="jenis_transaksi" class="form-select" required>
                    <option value="Penimbangan" <?= $transaksi['jenis_transaksi'] == 'Penimbangan' ? 'selected' : '' ?>>Penimbangan</option>
                    <option value="Imunisasi" <?= $transaksi['jenis_transaksi'] == 'Imunisasi' ? 'selected' : '' ?>>Imunisasi</option>
                    <option value="Vitamin" <?= $transaksi['jenis_transaksi'] == 'Vitamin' ? 'selected' : '' ?>>Vitamin</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="<?= htmlspecialchars($transaksi['jumlah']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($transaksi['tanggal']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"><?= htmlspecialchars($transaksi['keterangan']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="data-transaksi.html.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
