<?php
session_start();
// Periksa apakah cookie 'email' masih aktif
if (!isset($_COOKIE['email'])) {
    // Jika cookie habis, hapus session dan arahkan ke login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Periksa apakah session masih ada (antisipasi manual logout)
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

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

    // Proses Upload Foto Diri
    if (isset($_FILES['foto_diri']) && $_FILES['foto_diri']['error'] === UPLOAD_ERR_OK) {
        $foto_diri = $_FILES['foto_diri'];
        $target_dir = "Uploads/foto_diri/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($foto_diri['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.history.back();</script>";
            exit();
        }

        // Ganti nama file dengan nama_lengkap dan timestamp
        $sanitized_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_lengkap));
        $foto_name = $sanitized_name . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $foto_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($foto_diri['tmp_name'], $target_file)) {
            $foto_path = $foto_name;

            // Hapus foto lama jika ada
            if (!empty($penduduk['foto_diri']) && file_exists($target_dir . $penduduk['foto_diri'])) {
                unlink($target_dir . $penduduk['foto_diri']);
            }

            // Tambahkan kolom foto_diri ke query
            $query = "UPDATE penduduk SET 
                      daerah_id = '$daerah_id',
                      kk = '$kk',
                      nama_lengkap = '$nama_lengkap', 
                      jenis_kelamin = '$jenis_kelamin',
                      tanggal_lahir = '$tanggal_lahir',
                      tempat_lahir = '$tempat_lahir',
                      pekerjaan = '$pekerjaan',
                      gaji = '$gaji',
                      jumlah_keluarga = '$jumlah_keluarga',
                      foto_diri = '$foto_path'
                      WHERE nik = '$nik'";
        } else {
            echo "<script>alert('Gagal memindahkan file!'); window.history.back();</script>";
            exit();
        }
    } else {
        // Jika tidak ada file yang diunggah, gunakan query tanpa perubahan foto_diri
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
    }

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
        <form method="post" action="" enctype="multipart/form-data">
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

            <!-- Foto Diri -->
            <div class="mb-3">
                <label for="foto_diri" class="form-label">Foto Diri</label>
                <input type="file" class="form-control" id="foto_diri" name="foto_diri" accept="image/*">
                <?php if (!empty($penduduk['foto_diri'])): ?>
                    <p class="mt-2">Foto Saat Ini:</p>
                    <img src="Uploads/foto_diri/<?php echo htmlspecialchars($penduduk['foto_diri']); ?>" alt="Foto Diri" style="max-width: 200px; height: auto;">
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
