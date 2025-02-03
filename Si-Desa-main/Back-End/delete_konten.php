<?php
include 'Koneksi/koneksi.php';

// Ambil semua nama file gambar sebelum menghapus data
$result = $conn->query("SELECT photo FROM content");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $photoPath = "uploads/" . $row['photo'];
        if (file_exists($photoPath)) {
            unlink($photoPath); // Menghapus file gambar
        }
    }
}

// Hapus semua data di tabel content
if ($conn->query("TRUNCATE TABLE content") === TRUE) {
    echo "<script>alert('Semua data berhasil dihapus!'); window.location.href='../konten.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); console.log('Error: " . $conn->error . "');</script>";
}

$conn->close();
?>
