<?php
session_start();
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bantuan_kelompok_id = $_POST['bantuan_kelompok_id'];
    $nama_bantuan = $_POST['nama_bantuan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
    $status = $_POST['status'];

    // Query untuk update data
    $queryUpdate = "
        UPDATE bantuan_kelompok
        SET 
            nama_bantuan = ?,
            jenis_bantuan = ?,
            status = ?,
            updated_at = CURRENT_TIMESTAMP
        WHERE bantuan_kelompok_id = ?
    ";
    $stmt = $conn->prepare($queryUpdate);
    $stmt->bind_param("sssi", $nama_bantuan, $jenis_bantuan, $status, $bantuan_kelompok_id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../BantuanSosialKelompok.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
