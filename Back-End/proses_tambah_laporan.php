<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dan user_id dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($role != 'user') {
    header("Location: dashboard.php"); // Redirect ke dashboard admin jika bukan user
    exit();
}

// Pastikan user_id ada
if (!$user_id) {
    $_SESSION['errorMessage'] = "Kesalahan: User ID tidak ditemukan.";
    header("Location: login.php");
    exit();
}

include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pelapor = $conn->real_escape_string($_POST['nama_pelapor']);
    $daerah_id = $conn->real_escape_string($_POST['daerah_id']);
    $laporan = $conn->real_escape_string($_POST['laporan']);

    // Tangani upload foto aduan
    if (isset($_FILES['foto_aduan']) && $_FILES['foto_aduan']['error'] == 0) {
        $target_dir = "uploads/fotoaduan/";
        
        // Pastikan folder ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Ambil ekstensi file
        $file_ext = strtolower(pathinfo($_FILES['foto_aduan']['name'], PATHINFO_EXTENSION));

        // Generate nama file unik & hapus spasi
        $new_file_name = time() . "_" . uniqid() . "." . $file_ext;
        $target_file = $target_dir . $new_file_name;

        // Daftar tipe file yang diizinkan
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_ext, $allowed_types)) {
            if (move_uploaded_file($_FILES['foto_aduan']['tmp_name'], $target_file)) {
                // Simpan data ke database
                $sql = "INSERT INTO laporan (nama_pelapor, daerah_id, laporan, foto_aduan, user_id) 
                        VALUES ('$nama_pelapor', '$daerah_id', '$laporan', '$target_file', '$user_id')";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['successMessage'] = "Laporan berhasil dikirim!";
                } else {
                    $_SESSION['errorMessage'] = "Error: " . $conn->error;
                }
            } else {
                $_SESSION['errorMessage'] = "Gagal mengunggah file.";
            }
        } else {
            $_SESSION['errorMessage'] = "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        }
    } else {
        $_SESSION['errorMessage'] = "File foto aduan tidak ditemukan atau terjadi kesalahan.";
    }

    // Redirect ke createLaporan.php setelah proses selesai
    header("Location: ../createLaporan.php");
    exit();
}
?>