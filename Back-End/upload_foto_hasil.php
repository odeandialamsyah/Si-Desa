<?php
// Koneksi ke database
include 'Koneksi/koneksi.php';

// Pastikan metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $laporan_id = $_POST['laporan_id'];
    $foto_hasil = $_FILES['foto_hasil'];

    // Validasi apakah file diunggah
    if (isset($foto_hasil) && $foto_hasil['error'] === 0) {
        // Tentukan lokasi upload
        $upload_dir = 'uploads/fotohasil/';
        
        // Pastikan folder ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate nama file unik & hapus spasi
        $filename = time() . '_' . preg_replace('/\s+/', '_', basename($foto_hasil['name']));
        $destination = $upload_dir . $filename;

        // Validasi tipe file (hanya gambar)
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($foto_hasil['type'], $allowed_types)) {
            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($foto_hasil['tmp_name'], $destination)) {
                // Update nama file ke database
                $query = "UPDATE laporan SET foto_hasil = '$filename' WHERE laporan_id = '$laporan_id'";
                if (mysqli_query($conn, $query)) {
                    // Redirect dengan pesan sukses
                    header("Location: ../laporan.php?upload_success=true");
                    exit();
                } else {
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
