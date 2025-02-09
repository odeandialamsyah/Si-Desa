<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter bantuan_id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['bantuan_kelompok_id'])) {
    $bantuan_kelompok_id = $_GET['bantuan_kelompok_id'];

    // Hapus dari batch_users terlebih dahulu
    $sql_batch = "DELETE FROM batch_users WHERE batch_id = ?";
    $stmt_batch = $conn->prepare($sql_batch);
    $stmt_batch->bind_param("i", $bantuan_kelompok_id);
    $stmt_batch->execute();

    // Hapus dari bantuan_kelompok
    $sql_bantuan = "DELETE FROM bantuan_kelompok WHERE bantuan_kelompok_id = ?";
    $stmt_bantuan = $conn->prepare($sql_bantuan);
    $stmt_bantuan->bind_param("i", $bantuan_kelompok_id);
    if ($stmt_bantuan->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../BantuanSosialKelompok.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.history.back();</script>";
    }

    $stmt_batch->close();
    $stmt_bantuan->close();
    $conn->close();
}
