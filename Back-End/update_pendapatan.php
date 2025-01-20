<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input nama potensi desa
    if (empty($_POST['nama_pendapatan'])) {
        echo "<script>alert('Nama pendapatan desa tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }
    $nama_pendapatan = $_POST['nama_pendapatan'];

    // Validasi input tanggal
    if (empty($_POST['tanggal_dibuat'])) {
        echo "<script>alert('Tanggal dibuat tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }
    $tanggal = $_POST['tanggal_dibuat'];

    // Validasi ID Potensi Desa
    if (empty($_POST['pendapatan_id'])) {
        echo "<script>alert('ID Pendapatan Desa tidak ditemukan!'); window.history.back();</script>";
        exit;
    }
    $pendapatan_id = $_POST['pendapatan_id'];

    // Proses Upload Gambar (jika ada file yang diunggah)
    if (isset($_FILES['gambar_pendapatan']) && $_FILES['gambar_pendapatan']['error'] === UPLOAD_ERR_OK) {
        $gambar_pariwisata = $_FILES['gambar_pendapatan'];
        $target_dir = "Uploads/gambar_pendapatan/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($gambar_pendapatan['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi format file
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.history.back();</script>";
            exit;
        }

        // Validasi ukuran file (maksimum 5MB)
        if ($gambar_pendapatan['size'] > 5000000) {
            echo "<script>alert('Ukuran file terlalu besar! Maksimum 5MB.'); window.history.back();</script>";
            exit;
        }

        // Ganti nama file dengan nama_pendapatan
        $sanitized_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_pendapatan));
        $foto_name = $sanitized_name . '.' . $imageFileType;
        $target_file = $target_dir . $foto_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($gambar_pendapatan['tmp_name'], $target_file)) {
            $foto_path = $target_file; // Simpan path lengkap ke file
        } else {
            echo "<script>alert('Gagal mengunggah gambar pendapatan!'); window.history.back();</script>";
            exit;
        }
    } else {
        $foto_path = NULL; // Jika tidak ada file yang diunggah
    }

    // Query SQL untuk memperbarui data
    $sql = "UPDATE pendapatan_desa SET nama_pendapatan = ?, tanggal_dibuat = ?, gambar_pendapatan = COALESCE(?, gambar_pendapatan) WHERE pendapatan_id = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssi", // Total 4 tipe data
        $nama_pendapatan,   // s
        $tanggal,           // s
        $foto_path,         // s (NULL jika tidak ada file baru)
        $pendapatan_id         // i
    );

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data potensi desa berhasil diperbarui!'); window.location.href='../pendapatan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data. Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak melalui POST
    echo "<script>alert('Akses tidak diizinkan!'); window.location.href='../pendapatan.php';</script>";
}
?>