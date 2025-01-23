<?php
include 'Koneksi/koneksi.php';

// Cek apakah ada parameter id yang dikirimkan untuk menghapus content
if (isset($_GET['content_id'])) {
    $content_id = $_GET['content_id'];

    // Query untuk mendapatkan informasi content sebelum dihapus
    $stmt = $conn->prepare("SELECT photo FROM content WHERE content_id = ?");
    $stmt->bind_param("i", $content_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $content = $result->fetch_assoc();

    if ($content) {
        $photo = $content['photo'];

        // Hapus file gambar dari folder "uploads"
        $photoPath = "uploads/$photo";
        if (file_exists($photoPath)) {
            unlink($photoPath); // Menghapus file gambar
        }

        // Hapus data content dari database
        $deleteStmt = $conn->prepare("DELETE FROM content WHERE content_id = ?");
        $deleteStmt->bind_param("i", $content_id);

        if ($deleteStmt->execute()) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='konten.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!');</script>";
        }

        $deleteStmt->close();
    } else {
        echo "<script>alert('Content tidak ditemukan!'); window.location.href='dashboard.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='konten.php';</script>";
}
?>
