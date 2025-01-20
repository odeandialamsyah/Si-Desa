<?php
include 'Back-End/Koneksi/koneksi.php';

$user_id = $_GET['user_id']; // Ambil user_id dari URL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $kk = mysqli_real_escape_string($conn, $_POST['kk']);
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $foto_diri = 'path/to/uploaded/image.jpg'; // Ganti dengan logic upload file

    // Simpan data penduduk
    $query = "INSERT INTO penduduk (user_id, kk, nik, nama_lengkap, jenis_kelamin, tanggal_lahir, tempat_lahir, foto_diri) 
              VALUES ('$user_id', '$kk', '$nik', '$nama_lengkap', '$jenis_kelamin', '$tanggal_lahir', '$tempat_lahir', '$foto_diri')";
    if (mysqli_query($conn, $query)) {
        echo "Data penduduk berhasil disimpan!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Isi Data Penduduk</h2>
        <form action="dashboard.php?user_id=<?= $user_id ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="kk" class="form-label">KK</label>
                <input type="text" class="form-control" name="kk" id="kk" required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" id="nik" required>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required>
            </div>
            <div class="mb-3">
                <label for="foto_diri" class="form-label">Foto Diri</label>
                <input type="file" class="form-control" name="foto_diri" id="foto_diri" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
