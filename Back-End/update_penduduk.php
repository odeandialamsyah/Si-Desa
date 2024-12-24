<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    // Tambahkan data lain yang ingin diupdate

    // Query untuk update data
    $query = "UPDATE penduduk SET 
              nama_lengkap = '$nama_lengkap', 
              jenis_kelamin = '$jenis_kelamin'
              WHERE nik = '$nik'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='../dataPendu.php';</script>";
    } else {
        echo "<script>alert('Gagal update data!'); window.history.back();</script>";
    }
}
?>
