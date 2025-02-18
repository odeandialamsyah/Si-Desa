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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bantuan_id = $_POST['bantuan_id'];
    $nama_bantuan = $_POST['nama_bantuan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
    $foto_bukti = $_FILES['foto_bukti'];

    // Ambil foto lama dari database
    $query = "SELECT foto_bukti FROM bantuan WHERE bantuan_id = '$bantuan_id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $old_foto_bukti = $data['foto_bukti'];  // Foto lama

    // Proses update data bantuan
    $query = "UPDATE bantuan SET nama_bantuan = '$nama_bantuan', jenis_bantuan = '$jenis_bantuan' WHERE bantuan_id = '$bantuan_id'";

    if (mysqli_query($conn, $query)) {
        // Jika ada foto baru yang diupload
        if (isset($foto_bukti) && $foto_bukti['error'] === 0) {
            // Tentukan lokasi upload
            $upload_dir = '../uploads/';
            // Generate nama file unik untuk foto baru
            $filename = time() . '_' . basename($foto_bukti['name']);
            $destination = $upload_dir . $filename;

            // Validasi tipe file (hanya gambar)
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($foto_bukti['type'], $allowed_types)) {
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($foto_bukti['tmp_name'], $destination)) {
                    // Hapus foto lama jika ada
                    if ($old_foto_bukti && file_exists($upload_dir . $old_foto_bukti)) {
                        unlink($upload_dir . $old_foto_bukti);
                    }

                    // Update nama file foto ke database
                    $query = "UPDATE bantuan SET foto_bukti = '$filename' WHERE bantuan_id = '$bantuan_id'";
                    if (mysqli_query($conn, $query)) {
                        // Redirect dengan pesan sukses
                        echo "<script>alert('Data dan foto berhasil diupdate!'); window.location.href='../BantuanSosial.php';</script>";
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
            // Jika tidak ada foto baru, tetap gunakan foto lama
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../BantuanSosial.php';</script>";
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Ambil data dari database untuk form edit
if (isset($_GET['bantuan_id'])) {
    $bantuan_id = $_GET['bantuan_id'];

    // Ambil data dari database
    $query = "SELECT b.bantuan_id, b.nama_bantuan, b.jenis_bantuan, b.foto_bukti, p.kk, p.nama_lengkap, p.jumlah_keluarga, d.nama_daerah, b.penduduk_id 
              FROM bantuan b
              JOIN penduduk p ON b.penduduk_id = p.penduduk_id
              JOIN daerah d ON p.daerah_id = d.daerah_id
              WHERE b.bantuan_id = '$bantuan_id'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result); // Ambil hasil query dalam bentuk array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Bantuan Sosial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateBantuanLabel">Update Penerima Bantuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <input type="hidden" name="bantuan_id" value="<?php echo $data['bantuan_id']; ?>">

                        <!-- Nomor KK -->
                        <div class="mb-3">
                            <label for="kk" class="form-label">Nomor KK</label>
                            <input type="text" id="kk" class="form-control" value="<?php echo $data['kk']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                value="<?php echo $data['nama_lengkap']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_daerah" class="form-label">Nama Daerah</label>
                            <input type="text" class="form-control" id="nama_daerah" name="nama_daerah" 
                                value="<?php echo $data['nama_daerah']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                            <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" 
                                value="<?php echo $data['jumlah_keluarga']; ?>" readonly>
                        </div>

                        <!-- Nama Bantuan -->
                        <div class="mb-3">
                            <label for="nama_bantuan" class="form-label">Nama Bantuan</label>
                            <input type="text" class="form-control" id="nama_bantuan" name="nama_bantuan" 
                                value="<?php echo $data['nama_bantuan']; ?>" required>
                        </div>

                        <!-- Jenis Bantuan -->
                        <div class="mb-3">
                            <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                            <select class="form-control" id="jenis_bantuan" name="jenis_bantuan" required>
                                <option value="Uang Tunai" <?php echo ($data['jenis_bantuan'] == 'Uang Tunai') ? 'selected' : ''; ?>>Uang Tunai</option>
                                <option value="Barang" <?php echo ($data['jenis_bantuan'] == 'Barang') ? 'selected' : ''; ?>>Barang</option>
                                <option value="Jasa" <?php echo ($data['jenis_bantuan'] == 'Jasa') ? 'selected' : ''; ?>>Jasa</option>
                            </select>
                       </div>

                        <button type="submit" class="btn btn-primary">Update Bantuan</button>
                    </form>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>