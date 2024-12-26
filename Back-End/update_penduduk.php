<?php
include 'Koneksi/koneksi.php';

// Ambil NIK dari URL
$nik = $_GET['nik'];
$nik = mysqli_real_escape_string($conn, $nik);

// Query untuk mendapatkan data penduduk
$query = "SELECT * FROM penduduk WHERE nik = '$nik'";
$result = mysqli_query($conn, $query);
$penduduk = mysqli_fetch_assoc($result);

// Query untuk mendapatkan data desa
$queryDesa = "SELECT daerah_id, nama_daerah FROM daerah";
$resultDesa = mysqli_query($conn, $queryDesa);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $daerah_id = mysqli_real_escape_string($conn, $_POST['daerah_id']);
    $kk = mysqli_real_escape_string($conn, $_POST['kk']);
    $nik = $_POST['nik'];
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $pekerjaan = mysqli_real_escape_string($conn, $_POST['pekerjaan']);
    $gaji = mysqli_real_escape_string($conn, $_POST['gaji']);
    $jumlah_keluarga = mysqli_real_escape_string($conn, $_POST['jumlah_keluarga']);

    // Validasi KK (16 digit angka)
    if (!preg_match('/^\d{16}$/', $kk)) {
        echo "<script>alert('Nomor KK harus terdiri dari 16 digit angka!'); window.history.back();</script>";
        exit;
    }

    // Query untuk update data
    $query = "UPDATE penduduk SET 
              daerah_id = '$daerah_id',
              kk = '$kk',
              nama_lengkap = '$nama_lengkap', 
              jenis_kelamin = '$jenis_kelamin',
              tanggal_lahir = '$tanggal_lahir',
              tempat_lahir = '$tempat_lahir',
              pekerjaan = '$pekerjaan',
              gaji = '$gaji',
              jumlah_keluarga = '$jumlah_keluarga'
              WHERE nik = '$nik'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='../dataPenduduk.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Penduduk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Update Data Penduduk</h1>
        <form method="post" action="">
            <!-- KK -->
            <div class="mb-3">
                <label for="kk" class="form-label">KK</label>
                <input type="text" class="form-control" id="kk" name="kk" value="<?php echo htmlspecialchars($penduduk['kk']); ?>">
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?php echo htmlspecialchars($penduduk['nik']); ?>" readonly>
            </div>

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($penduduk['nama_lengkap']); ?>" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php echo ($penduduk['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($penduduk['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <!-- Desa -->
            <div class="mb-3">
                <label for="daerah_id" class="form-label">Desa</label>
                <select class="form-select" id="daerah_id" name="daerah_id" required>
                    <option value="">Pilih Desa</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultDesa)) {
                        $selected = ($penduduk['daerah_id'] == $row['daerah_id']) ? 'selected' : '';
                        echo "<option value='{$row['daerah_id']}' $selected>{$row['nama_daerah']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($penduduk['tanggal_lahir']); ?>" required>
            </div>

            <!-- Tempat Lahir -->
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($penduduk['tempat_lahir']); ?>" required>
            </div>

            <!-- Pekerjaan -->
            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo htmlspecialchars($penduduk['pekerjaan']); ?>" required>
            </div>

            <!-- Gaji -->
            <div class="mb-3">
                <label for="gaji" class="form-label">Gaji/Bulan</label>
                <input type="number" class="form-control" id="gaji" name="gaji" step="0.01" value="<?php echo htmlspecialchars($penduduk['gaji']); ?>" required>
            </div>

            <!-- Jumlah Keluarga -->
            <div class="mb-3">
                <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" value="<?php echo htmlspecialchars($penduduk['jumlah_keluarga']); ?>" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
