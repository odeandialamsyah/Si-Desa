<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah GET dan memiliki parameter nik
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['potensi_id'])) {
    // Ambil nik dari URL
    $potensi_id = $_GET['potensi_id'];

    // Query untuk mendapatkan informasi penduduk (termasuk foto)
    $query = "SELECT gambar_pariwisata FROM potensi_desa WHERE potensi_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $potensi_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $potensi = $result->fetch_assoc();

        // Hapus file foto jika ada
        $target_dir = "Uploads/gambar_pariwisata/";
        if (!empty($potensi['gambar_pariwisata']) && file_exists($target_dir . $potensi['gambar_pariwisata'])) {
            unlink($target_dir . $potensi['gambar_pariwisata']);
        }

        // Query untuk menghapus data dari database
        $sql = "DELETE FROM potensi_desa WHERE potensi_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $potensi_id);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data potensi dan fotonya berhasil dihapus!'); window.location.href='../potensi.php';</script>";
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
    echo "<script>alert('Akses tidak diizinkan atau data tidak valid!'); window.location.href='../potensi.php';</script>";
}
?>
