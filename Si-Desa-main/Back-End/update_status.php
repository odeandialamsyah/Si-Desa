<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bantuan_id = $_POST['bantuan_id'];
    $status = $_POST['status'];

    $query = "UPDATE bantuan SET status = '$status' WHERE bantuan_id = $bantuan_id";
    if (mysqli_query($conn, $query)) {
        header('Location: ../BantuanSosial.php?status=updated');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
