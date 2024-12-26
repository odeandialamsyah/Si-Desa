<?php
// Hubungkan ke database
include 'Koneksi/koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $daerah_id = $_POST['daerah_id'];
    $kk = $_POST['kk']; 
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $pekerjaan = !empty($_POST['pekerjaan']) ? $_POST['pekerjaan'] : NULL;
    $gaji = !empty($_POST['gaji']) ? $_POST['gaji'] : NULL;
    $jumlah_keluarga = !empty($_POST['jumlah_keluarga']) ? $_POST['jumlah_keluarga'] : 0;

    // Validasi KK (16 digit angka)
    if (!preg_match('/^\d{16}$/', $kk)) {
        echo "<script>alert('Nomor KK harus terdiri dari 16 digit angka!'); window.history.back();</script>";
        exit;
    }

    // Validasi NIK (16 digit angka)
    if (!preg_match('/^\d{16}$/', $nik)) {
        echo "<script>alert('Nomor NIK harus terdiri dari 16 digit angka!'); window.history.back();</script>";
        exit;
    }

    // **Cek apakah NIK sudah ada di database**
    $cekNIK = $conn->prepare("SELECT nik FROM Penduduk WHERE nik = ?");
    $cekNIK->bind_param("s", $nik);
    $cekNIK->execute();
    $cekNIK->store_result();

    if ($cekNIK->num_rows > 0) { // Jika ditemukan NIK yang sama
        echo "<script>alert('NIK sudah terdaftar! Gunakan NIK lain.'); window.history.back();</script>";
        $cekNIK->close();
        exit;
    }
    $cekNIK->close();

    // Query tambah data (tanpa agama_id)
    $sql = "INSERT INTO Penduduk 
            (daerah_id, kk, nik, nama_lengkap, jenis_kelamin, tanggal_lahir, tempat_lahir, pekerjaan, gaji, jumlah_keluarga, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssdi", // Total 10 tipe data
        $daerah_id,         // i
        $kk,                // s
        $nik,               // s
        $nama_lengkap,      // s
        $jenis_kelamin,     // s
        $tanggal_lahir,     // s
        $tempat_lahir,      // s
        $pekerjaan,         // s
        $gaji,              // d
        $jumlah_keluarga    // i
    );    

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data penduduk berhasil ditambahkan!'); window.location.href='../dataPenduduk.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data. Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika akses tidak melalui POST
    echo "<script>alert('Akses tidak diizinkan!'); window.location.href='../dataPenduduk.php';</script>";
}
?>
