<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter nik
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nik'])) {
    // Ambil nik dari URL
    $nik = $_GET['nik'];

    // Query untuk menghapus data
    $sql = "DELETE FROM Penduduk WHERE nik = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nik);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data penduduk berhasil dihapus!'); window.location.href='../dataPenduduk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data. Silakan coba lagi.'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak valid
    echo "<script>alert('Akses tidak diizinkan atau data tidak valid!'); window.location.href='../dataPenduduk.php';</script>";
}
?>
