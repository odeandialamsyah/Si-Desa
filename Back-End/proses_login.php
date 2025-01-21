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
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];

        // Regenerate session ID
        session_regenerate_id(true);

        // Redirect berdasarkan role
        if ($row['role'] === 'admin') {
            header("Location: ../dashboard.php");
        } else {
            header("Location: ../dashboardUser.php");
        }
        exit;
    } else {
        echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
    }
} else {
    echo "<script>alert('Email atau Password salah!'); window.location.href='../login.php';</script>";
}

$conn->close();
?>
