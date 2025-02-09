<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $laporan_id = $_POST['laporan_id'];
    $status = $_POST['status'];

    $query = "UPDATE laporan SET status = '$status' WHERE laporan_id = $laporan_id";
    if (mysqli_query($conn, $query)) {
        header('Location: ../laporan.php?status=updated');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
