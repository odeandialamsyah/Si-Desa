<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter nik
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nik'])) {
    // Ambil nik dari URL
    $nik = $_GET['nik'];

    // Query untuk mendapatkan informasi penduduk (termasuk foto)
    $query = "SELECT foto_diri FROM Penduduk WHERE nik = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $penduduk = $result->fetch_assoc();

        // Hapus file foto jika ada
        $target_dir = "Uploads/foto_diri/";
        if (!empty($penduduk['foto_diri']) && file_exists($target_dir . $penduduk['foto_diri'])) {
            unlink($target_dir . $penduduk['foto_diri']);
        }

        // Query untuk menghapus data dari database
        $sql = "DELETE FROM Penduduk WHERE nik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nik);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data penduduk dan fotonya berhasil dihapus!'); window.location.href='../dataPenduduk.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data. Silakan coba lagi.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak valid
    echo "<script>alert('Akses tidak diizinkan atau data tidak valid!'); window.location.href='../dataPenduduk.php';</script>";
}
?>
