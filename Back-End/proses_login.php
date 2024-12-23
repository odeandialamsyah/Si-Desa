<?php
include 'Koneksi/koneksi.php';
session_start();
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
    setcookie('email', $row['email'], time() + (15 * 60), "/dashboard");
    // Ini mengatur cookie untuk 60 detik, untuk pengujian
    // setcookie('email', $row['email'], time() + (60), "/");

    header("Location: ../dashboard.php");
} else {
    echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
}

$conn->close();
?>
