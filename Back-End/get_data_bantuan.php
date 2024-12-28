<?php
// Koneksi ke database
include 'Koneksi/koneksi.php';

if (isset($_GET['bantuan_id'])) {
    $bantuan_id = $_GET['bantuan_id'];

    // Ambil data dari database
    $query = "SELECT b.bantuan_id, b.nama_bantuan, b.jenis_bantuan, p.kk, p.nama_lengkap, b.penduduk_id 
              FROM bantuan b
              JOIN penduduk p ON b.penduduk_id = p.penduduk_id
              WHERE b.bantuan_id = '$bantuan_id'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result); // Ambil hasil query dalam bentuk array
}

?>