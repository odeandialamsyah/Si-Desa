<?php
// Koneksi ke database
include 'Koneksi/koneksi.php';

// Pastikan metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $bantuan_id = $_POST['bantuan_kelompok_id'];
    $foto_bukti = $_FILES['foto_bukti_kelompok'];

    // Validasi apakah file diunggah
    if (isset($foto_bukti) && $foto_bukti['error'] === 0) {
        // Tentukan lokasi upload
        $upload_dir = '../uploads/';
        // Generate nama file unik
        $filename = time() . '_' . basename($foto_bukti['name']);
        $destination = $upload_dir . $filename;

        // Validasi tipe file (hanya gambar)
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($foto_bukti['type'], $allowed_types)) {
            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($foto_bukti['tmp_name'], $destination)) {
                // Update nama file ke database
                $query = "UPDATE bantuan_kelompok SET foto_bukti_kelompok = '$filename' WHERE bantuan_kelompok_id = '$bantuan_id'";
                if (mysqli_query($conn, $query)) {
                    // Redirect dengan pesan sukses
                    header("Location: ../BantuanSosialKelompok.php?upload_success=true");
                    exit();
                } else {
                    // Tampilkan pesan error jika query gagal
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            echo "Tipe file tidak valid. Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>
