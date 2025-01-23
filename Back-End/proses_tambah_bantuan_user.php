<?php
// Koneksi database
include 'Koneksi/koneksi.php'; // Pastikan koneksi sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $user_id = $_POST['user_id'];
    $penduduk_id = $_POST['penduduk_id'];
    $nama_bantuan = $_POST['nama_bantuan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];

    // Query untuk memasukkan data ke dalam tabel bantuan
    $query = "INSERT INTO bantuan (penduduk_id, user_id, nama_bantuan, jenis_bantuan) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('iiss', $penduduk_id, $user_id, $nama_bantuan, $jenis_bantuan);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Data Bantuan berhasil ditambahkan!'); window.location.href='../bantuan.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data. Silakan coba lagi.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    echo "Method tidak valid!";
}
?>
