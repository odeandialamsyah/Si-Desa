<?php
// Hapus cookie
setcookie('email', '', time() - 3600, '/dashboard.php'); // Cookie dihapus dengan waktu kadaluarsa ke masa lalu

// Hapus session
session_unset();
session_destroy();


// Arahkan ke halaman login
header("Location: ../index.php");
exit();
?>
