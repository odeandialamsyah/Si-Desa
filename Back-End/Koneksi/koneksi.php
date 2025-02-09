<?php
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database
$password = "";     // Sesuaikan dengan password database
$dbname = "si-desa-db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>