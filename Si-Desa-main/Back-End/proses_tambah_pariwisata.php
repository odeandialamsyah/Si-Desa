<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input nama pendapatan
    if (empty($_POST['nama_pariwisata'])) {
        echo "<script>alert('Nama potensi desa tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }
    $nama_pariwisata = $_POST['nama_pariwisata'];

    // Validasi input tanggal
    if (empty($_POST['create_at'])) {
        echo "<script>alert('Tanggal dibuat tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }
    $tanggal = $_POST['create_at'];

    // Proses Upload Gambar Pendapatan
    if (isset($_FILES['gambar_pariwisata']) && $_FILES['gambar_pariwisata']['error'] === UPLOAD_ERR_OK) {
        $gambar_pariwisata = $_FILES['gambar_pariwisata'];
        $target_dir = "Uploads/gambar_pariwisata/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($gambar_pariwisata['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi format file
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.history.back();</script>";
            exit;
        }

        // Validasi ukuran file (maksimum 5MB)
        if ($gambar_pariwisata['size'] > 5000000) {
            echo "<script>alert('Ukuran file terlalu besar! Maksimum 5MB.'); window.history.back();</script>";
            exit;
        }

        // Ganti nama file dengan nama_pendapatan
        $sanitized_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_pariwisata));
        $foto_name = $sanitized_name . '.' . $imageFileType;
        $target_file = $target_dir . $foto_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($gambar_pariwisata['tmp_name'], $target_file)) {
            $foto_path = $target_file; // Simpan path lengkap ke file
        } else {
            echo "<script>alert('Gagal mengunggah gambar pendapatan!'); window.history.back();</script>";
            exit;
        }
    } else {
        $foto_path = NULL; // Jika tidak ada file yang diunggah
    }

    // Query SQL untuk menambahkan data
    $sql = "INSERT INTO potensi_desa (nama_pariwisata, create_at, gambar_pariwisata) VALUES (?, ?, ?)";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sss", // Total 3 tipe data
        $nama_pariwisata,   // s
        $tanggal,           // s
        $foto_path          // s
    );

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data pendapatan berhasil ditambahkan!'); window.location.href='../potensi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data. Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak melalui POST
    echo "<script>alert('Akses tidak diizinkan!'); window.location.href='../potensi.php';</script>";
}
?>
