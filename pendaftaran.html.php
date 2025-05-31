<?php
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $tgl = $_POST["tanggal_lahir"];
    $orang_tua = $_POST["orang_tua"];
    $alamat = $_POST["alamat"];
    $jk = $_POST["jenis_kelamin"] ?? '';
    $berat = $_POST["berat_badan"] ?? '';
    $tinggi = $_POST["tinggi_badan"] ?? '';
    $imt = $_POST["imt"] ?? '';

    // Pastikan field orang_tua dan alamat juga dimasukkan ke database jika ingin disimpan
    $sql = "INSERT INTO balita (nama, tanggal_lahir, orang_tua, alamat, jenis_kelamin, berat_badan, tinggi_badan, imt) 
            VALUES ('$nama', '$tgl', '$orang_tua', '$alamat', '$jk', '$berat', '$tinggi', '$imt')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Data berhasil disimpan!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/1.css">
    <title>Pendaftaran Balita</title>
</head>
<body>
    <div class="navbar">
        <img src="img/logo.png" alt="Logo Posyandu" class="logo" />
        <a href="index.html.php">Beranda</a>
        <a href="profil.html.php">Profil</a>
        <a href="layanan.html.php">Layanan</a>
        <a href="pendaftaran.html.php" class="active">Pendaftaran Balita</a>
        <a href="data-balita.html.php">Data Balita</a>
        <a href="transaksi.html.php">Transaksi</a>
        <a href="data-transaksi.html.php">Data Transaksi</a>
    </div>
    <div class="main-content">
        <div class="container">
            <section class="daftar-balita">
                <h2 class="text-center">Pendaftaran Balita</h2>
                <p class="daftar-desc">
                    Daftarkan buah hati Anda untuk mendapatkan layanan Posyandu secara rutin dan terpantau kesehatannya.<br>
                    Isi formulir berikut dengan data yang benar.
                </p>
                <form id="formPendaftaran" class="form-daftar" method="POST" action="">
                    <div class="form-row">
                        <label for="nama">Nama Balita</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    <div class="form-row">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-row">
                        <label for="orang_tua">Nama Orang Tua</label>
                        <input type="text" id="orang_tua" name="orang_tua" required>
                    </div>
                    <div class="form-row">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" required rows="2"></textarea>
                    </div>
                    <div class="form-row">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="berat">Berat Badan (kg)</label>
                        <input type="number" id="berat" name="berat_badan" min="1" step="0.1" onchange="hitungIMT();" required>
                    </div>
                    <div class="form-row">
                        <label for="tinggi">Tinggi Badan (cm)</label>
                        <input type="number" id="tinggi" name="tinggi_badan" min="30" step="0.1" onchange="hitungIMT();" required>
                    </div>
                    <div class="form-row">
                        <label for="imt">IMT</label>
                        <input type="text" id="imt" name="imt" readonly>
                    </div>
                    <button type="submit" class="btn-daftar">Daftar</button>
                </form>
                <div id="pesanSukses" class="pesan-sukses" style="display:none;">
                    <img src="img/daftar-success.png" alt="Sukses" style="width:50px;margin-bottom:10px;">
                    <p>Pendaftaran berhasil! Data balita Anda telah tercatat.</p>
                </div>
            </section>
        </div>
    </div>
    <script>
    function hitungIMT() {
        const berat = parseFloat(document.getElementById("berat").value) || 0;
        const tinggi = parseFloat(document.getElementById("tinggi").value) / 100 || 0;
        if (berat > 0 && tinggi > 0) {
            const imt = (berat / (tinggi * tinggi)).toFixed(2);
            document.getElementById("imt").value = imt;
        } else {
            document.getElementById("imt").value = '';
        }
    }
    </script>
</body>
</html>