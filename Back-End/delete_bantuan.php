<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter bantuan_id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['bantuan_id'])) {
    // Ambil bantuan_id dari URL
    $bantuan_id = $_GET['bantuan_id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM bantuan WHERE bantuan_id = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bantuan_id);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data Bantuan berhasil dihapus!'); window.location.href='../BantuanSosial.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data. Silakan coba lagi.'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak valid
    echo "<script>alert('Akses tidak diizinkan atau data tidak valid!'); window.location.href='../BantuanSosial.php';</script>";
}
?>
