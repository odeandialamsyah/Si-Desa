<?php
session_start();
include 'Koneksi/koneksi.php';

// Mengambil input dari form
$email = $_POST['email'];
$password = md5($_POST['password']);

// Query untuk memeriksa user
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['email'] = $row['email'];

    // Mengatur cookie untuk 15 menit
    setcookie('email', $row['email'], time() + (15 * 60), "/");
    // Ini mengatur cookie untuk 60 detik, untuk pengujian
    // setcookie('email', $row['email'], time() + (60), "/");

    header("Location: ../index.php");
} else {
    echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
}

$conn->close();
?>
