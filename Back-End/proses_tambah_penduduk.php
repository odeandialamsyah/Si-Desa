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
            exit;
        }

        // Ganti nama file dengan nama_lengkap
        $sanitized_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_lengkap));
        $foto_name = $sanitized_name . '.' . $imageFileType;
        $target_file = $target_dir . $foto_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($foto_diri['tmp_name'], $target_file)) {
            $foto_path = $foto_name;
        } else {
            echo "<script>alert('Gagal mengunggah foto diri!'); window.history.back();</script>";
            exit;
        }
    } else {
        $foto_path = NULL; // Jika tidak ada file yang diunggah
    }

    // Proses Upload File NIK
    if (isset($_FILES['file_nik']) && $_FILES['file_nik']['error'] === UPLOAD_ERR_OK) {
        $file_nik = $_FILES['file_nik'];
        $target_dir_nik = "Uploads/file_nik/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir_nik)) {
            mkdir($target_dir_nik, 0777, true);
        }

        $fileExtension = strtolower(pathinfo($file_nik['name'], PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'doc', 'docx'];

        if (!in_array($fileExtension, $allowed_types)) {
            echo "<script>alert('Format file tidak valid untuk file NIK! Hanya PDF, DOC, dan DOCX yang diizinkan.'); window.history.back();</script>";
            exit;
        }

        $file_nik_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_lengkap)) . "_nik." . $fileExtension;
        $target_file_nik = $target_dir_nik . $file_nik_name;

        if (move_uploaded_file($file_nik['tmp_name'], $target_file_nik)) {
            $file_nik_path = $file_nik_name;
        } else {
            echo "<script>alert('Gagal mengunggah file NIK!'); window.history.back();</script>";
            exit;
        }
    } else {
        $file_nik_path = NULL; // Jika tidak ada file yang diunggah
    }

    // Proses Upload File KK
    if (isset($_FILES['file_kk']) && $_FILES['file_kk']['error'] === UPLOAD_ERR_OK) {
        $file_kk = $_FILES['file_kk'];
        $target_dir_kk = "Uploads/file_kk/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir_kk)) {
            mkdir($target_dir_kk, 0777, true);
        }

        $fileExtension = strtolower(pathinfo($file_kk['name'], PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'doc', 'docx'];

        if (!in_array($fileExtension, $allowed_types)) {
            echo "<script>alert('Format file tidak valid untuk file KK! Hanya PDF, DOC, dan DOCX yang diizinkan.'); window.history.back();</script>";
            exit;
        }

        $file_kk_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nama_lengkap)) . "_kk." . $fileExtension;
        $target_file_kk = $target_dir_kk . $file_kk_name;

        if (move_uploaded_file($file_kk['tmp_name'], $target_file_kk)) {
            $file_kk_path = $file_kk_name;
        } else {
            echo "<script>alert('Gagal mengunggah file KK!'); window.history.back();</script>";
            exit;
        }
    } else {
        $file_kk_path = NULL; // Jika tidak ada file yang diunggah
    }


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
            (daerah_id, kk, nik, nama_lengkap, jenis_kelamin, tanggal_lahir, tempat_lahir, pekerjaan, gaji, jumlah_keluarga, foto_diri, file_nik, file_kk, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssdisss", // Total 12 tipe data
        $daerah_id,         // i
        $kk,                // s
        $nik,               // s
        $nama_lengkap,      // s
        $jenis_kelamin,     // s
        $tanggal_lahir,     // s
        $tempat_lahir,      // s
        $pekerjaan,         // s
        $gaji,              // d
        $jumlah_keluarga,   // i
        $foto_path,         // s
        $file_nik_path,     // s
        $file_kk_path       // s
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
