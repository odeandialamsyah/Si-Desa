<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bantuan_kelompok_id = $_POST['bantuan_kelompok_id'];
    $status = $_POST['status'];

    $query = "UPDATE bantuan_kelompok SET status = '$status' WHERE bantuan_kelompok_id = $bantuan_kelompok_id";
    if (mysqli_query($conn, $query)) {
        header('Location: ../BantuanSosialKelompok.php?status=updated');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
