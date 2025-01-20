<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validasi email dan password
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid.";
    } elseif (strlen($password) < 6) {
        $error = "Password harus lebih dari 6 karakter.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email_query);
        if (mysqli_num_rows($result) > 0) {
            $error = "Email sudah terdaftar.";
        } else {
            // Simpan user ke tabel users
            $insert_query = "INSERT INTO users (email, password, role) VALUES ('$email', '$hashed_password', 'user')";
            if (mysqli_query($conn, $insert_query)) {
                // Ambil ID user yang baru saja didaftarkan
                $user_id = mysqli_insert_id($conn);

                // Redirect ke halaman dashboard untuk mengisi data penduduk
                header("Location: ../dashboard.php?user_id=$user_id");
                exit;
            } else {
                $error = "Terjadi kesalahan. Coba lagi nanti.";
            }
        }
    }
}
?>