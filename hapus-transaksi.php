<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM transaksi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: data-transaksi.html.php?hapus=sukses");
        exit;
    } else {
        header("Location: data-transaksi.html.php?hapus=gagal");
        exit;
    }
} else {
    header("Location: data-transaksi.html.php?hapus=invalid");
    exit;
}
?>                                                                                