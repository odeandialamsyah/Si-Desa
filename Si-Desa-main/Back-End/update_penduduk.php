<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

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

     // Direktori upload
     $target_dir_kk = "Uploads/file_kk/";
     $target_dir_nik = "Uploads/file_nik/";
 
     // Buat folder jika belum ada
     if (!file_exists($target_dir_kk)) {
         mkdir($target_dir_kk, 0777, true);
     }
     if (!file_exists($target_dir_nik)) {
         mkdir($target_dir_nik, 0777, true);
     }
 
     // Proses Upload File KK
     if (isset($_FILES['file_kk']) && $_FILES['file_kk']['error'] === UPLOAD_ERR_OK) {
         $file_kk = $_FILES['file_kk'];
         $file_kk_ext = strtolower(pathinfo($file_kk['name'], PATHINFO_EXTENSION));
         $file_kk_name = "kk_" . time() . ".$file_kk_ext";
         $file_kk_path = $target_dir_kk . $file_kk_name;
 
         // Pindahkan file dan hapus file lama jika ada
         if (move_uploaded_file($file_kk['tmp_name'], $file_kk_path)) {
             if (!empty($penduduk['file_kk']) && file_exists($target_dir_kk . $penduduk['file_kk'])) {
                 unlink($target_dir_kk . $penduduk['file_kk']);
             }
             $penduduk['file_kk'] = $file_kk_name;
         } else {
             echo "<script>alert('Gagal mengunggah file KK!'); window.history.back();</script>";
             exit;
         }
     }
 
     // Proses Upload File NIK
     if (isset($_FILES['file_nik']) && $_FILES['file_nik']['error'] === UPLOAD_ERR_OK) {
         $file_nik = $_FILES['file_nik'];
         $file_nik_ext = strtolower(pathinfo($file_nik['name'], PATHINFO_EXTENSION));
         $file_nik_name = "nik_" . time() . ".$file_nik_ext";
         $file_nik_path = $target_dir_nik . $file_nik_name;
 
         // Pindahkan file dan hapus file lama jika ada
         if (move_uploaded_file($file_nik['tmp_name'], $file_nik_path)) {
             if (!empty($penduduk['file_nik']) && file_exists($target_dir_nik . $penduduk['file_nik'])) {
                 unlink($target_dir_nik . $penduduk['file_nik']);
             }
             $penduduk['file_nik'] = $file_nik_name;
         } else {
             echo "<script>alert('Gagal mengunggah file NIK!'); window.history.back();</script>";
             exit;
         }
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
                      foto_diri = '$foto_path',
                      file_kk = '{$penduduk['file_kk']}',
                      file_nik = '{$penduduk['file_nik']}'
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