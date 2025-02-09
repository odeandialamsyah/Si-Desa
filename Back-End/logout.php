<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Jika ingin menghapus cookie sesi juga, hapus cookie sesi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hapus cookie lainnya jika ada
setcookie('email', '', time() - 3600, '/');

// Hapus sesi
session_unset();
session_destroy();

// Arahkan ke halaman login
header("Location: ../index.php");
exit();
?>
