<?php
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid.";
    } elseif (strlen($password) < 6) {
        $error = "Password harus lebih dari 6 karakter.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email exists
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($result) > 0) {
            $error = "Email sudah terdaftar.";
        } else {
            $insert_query = "INSERT INTO users (email, password, role) VALUES ('$email', '$hashed_password', 'user')";

            if (mysqli_query($conn, $insert_query)) {
                $user_id = mysqli_insert_id($conn);
                // header("Location: ../dashboardUser.php?user_id=$user_id");
                header("Location: ../login.php?success=".urlencode("Registrasi berhasil. Silakan login."));
                exit;
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        }
    }

    // If there's an error, include the error message in the response.
    if (isset($error)) {
        header("Location: ../register.php?error=" . urlencode($error));
        exit;
    }
}
?>


