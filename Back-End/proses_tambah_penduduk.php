<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $daerah_id = $_POST['daerah_id'];
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $pekerjaan = !empty($_POST['pekerjaan']) ? $_POST['pekerjaan'] : NULL;
    $gaji = !empty($_POST['gaji']) ? $_POST['gaji'] : NULL;
    $jumlah_keluarga = !empty($_POST['jumlah_keluarga']) ? $_POST['jumlah_keluarga'] : 0;

    // Query tambah data
    $sql = "INSERT INTO Penduduk 
            (daerah_id, nik, nama_lengkap, jenis_kelamin, tanggal_lahir, tempat_lahir, pekerjaan, gaji, jumlah_keluarga, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssssdi",
        $daerah_id,
        $nik,
        $nama_lengkap,
        $jenis_kelamin,
        $tanggal_lahir,
        $tempat_lahir,
        $pekerjaan,
        $gaji,
        $jumlah_keluarga
    );    

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data penduduk berhasil ditambahkan!'); window.location.href='../dataPenduduk.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data. Silakan coba lagi.'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak melalui POST
    echo "<script>alert('Akses tidak diizinkan!'); window.location.href='../dataPenduduk.php';</script>";
}
?>
