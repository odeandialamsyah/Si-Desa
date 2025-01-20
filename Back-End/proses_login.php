<?php
include 'Koneksi/koneksi.php';
session_start();

// Mengambil input dari form login
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Query untuk memeriksa user berdasarkan email
$sql = "SELECT * FROM users WHERE email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Memverifikasi password dengan password yang di-hash
    if (password_verify($password, $row['password'])) {
        // Set session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role']; // Menyimpan role jika dibutuhkan

        // Mengatur cookie untuk 15 menit
        setcookie('email', $row['email'], time() + (15 * 60), "/");

        // Redirect ke halaman dashboard
        header("Location: ../dashboard.php");
        exit;
    } else {
        // Password salah
        echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
    }
} else {
    // Email tidak ditemukan
    echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
}

$conn->close();
?>
