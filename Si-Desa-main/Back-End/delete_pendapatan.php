<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pendapatan_id'])) {
    // Ambil id dari URL
    $pendapatan_id = $_GET['pendapatan_id'];

    // Query untuk mendapatkan informasi pendapatan (termasuk foto)
    $query = "SELECT gambar_pendapatan FROM pendapatan_desa WHERE pendapatan_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $pendapatan_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pendapatan = $result->fetch_assoc();

        // Hapus file foto jika ada
        $target_dir = "Uploads/gambar_pendapatan/";
        if (!empty($potensi['gambar_pendapatan']) && file_exists($target_dir . $potensi['gambar_pendapatan'])) {
            unlink($target_dir . $potensi['gambar_pendapatan']);
        }

        // Query untuk menghapus data dari database
        $sql = "DELETE FROM pendapatan_desa WHERE pendapatan_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $pendapatan_id);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data pendapatan dan fotonya berhasil dihapus!'); window.location.href='../konten.php';</script>";
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
    echo "<script>alert('Akses tidak diizinkan atau data tidak valid!'); window.location.href='../konten.php';</script>";
}
?>
