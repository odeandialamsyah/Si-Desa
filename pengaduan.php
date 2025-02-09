<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

// Include file koneksi
include 'Back-End/Koneksi/koneksi.php';

// Ambil data dari tabel laporan
$query = "SELECT laporan.laporan_id, laporan.nama_pelapor, daerah.nama_daerah, daerah.jenis_daerah, laporan.laporan, laporan.foto_aduan, laporan.foto_hasil,laporan.status, laporan.created_at 
FROM
laporan
JOIN daerah ON laporan.daerah_id = daerah.daerah_id
ORDER BY laporan.created_at DESC;";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dataAnggota.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Laporan Pengaduan</title>
    <style>
        .main-content {
            margin-left: 250px;
            /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
        }

        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: auto;
            max-width: 90%;
            margin-bottom: 20px;
            /* Tambahkan margin bawah untuk memberikan jarak antar table-container */
        }

        .table-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .table-container table {
            margin: auto;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><b>SID</b><span><b>esa</b></span></h3>
        </div>
        <div class="side-content">
            <div class="profile">
                <a href="dtlAdmn.html">
                    <div class="profile-img bg-img" style="background-image: url('img/admn.jpg'); cursor: pointer;"></div>
                </a>
                <h4 style="color: white;"><b>Cindy Mala Puput</b></h4>
            </div>
        </div>
        <div class="side-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="active" style="text-decoration: none;">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="dataKlasifikasi.php" style="text-decoration: none;">
                        <span class="fa fa-users"></span>
                        <small>Data Klasifikasi</small>
                    </a>
                </li>
                <li>
                    <a href="dataPenduduk.php" style="text-decoration: none;">
                        <span class="fa fa-user"></span>
                        <small>Data Penduduk</small>
                    </a>
                </li>
                <li>
                    <a href="BantuanSosial.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <li>
                    <a href="BantuanSosialKelompok.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small class="text-left">Bantuan Sosial Kelompok</small>
                    </a>
                </li>
                <li>
                    <a href="konten.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Konten</small>
                    </a>
                </li>
                <li>
                    <a href="laporan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan</small>
                    </a>
                </li>
                <li>
                    <a href="pengaduan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Pengaduan</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="fa-solid fa-bars mt-3" style="color: #fff;"></span>
                </label>
                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: #fff;"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: #fff;">
                        <b>Admin</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php">Profile</a></li>
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div class="table-container">
                <h2 class="text-center my-4"><b>Laporan Pengaduan</b></h2>
                <table class="table table-striped">
                    <thead style="background-color: #D9D9D9;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelapor</th>
                            <th scope="col">Daerah</th>
                            <th scope="col">Jenis Daerah</th>
                            <th scope="col">Laporan</th>
                            <th scope="col">Foto Laporan</th>
                            <th scope="col">Foto Tindak Laporan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_pelapor']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_daerah']) ?></td>
                                    <td><?= htmlspecialchars($row['jenis_daerah']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['laporan'])) ?></td>
                                    <td>
                                        <?php if ($row['foto_aduan']): ?>
                                            <img src="Back-End/<?= $row['foto_aduan'] ?>" alt="Foto Aduan" style="max-width: 100px; height: auto;">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['foto_hasil']) {
                                            echo "<img src='Back-End/uploads/fotohasil/{$row['foto_hasil']}' alt='Foto ' width='100'>";
                                        } elseif ($row['status'] == 'approved') {
                                            echo "
                                                <form action='Back-End/upload_foto_hasil.php' method='POST' enctype='multipart/form-data'>
                                                    <input type='hidden' name='laporan_id' value='{$row['laporan_id']}'>
                                                    <input type='file' name='foto_hasil' accept='image/*' required>
                                                    <button type='submit' class='btn btn-success btn-sm mt-1'>Upload</button>
                                                </form>";
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <form form action='Back-End/update_status_laporan.php' method='POST'>
                                            <input type="hidden" name="laporan_id" value="<?= $row['laporan_id'] ?>">
                                            <select name="status" class="form-select" onchange="this.form.submit()">
                                                <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                <option value="approved" <?= $row['status'] == 'approved' ? 'selected' : '' ?>>Diterima</option>
                                                <option value="rejected" <?= $row['status'] == 'rejected' ? 'selected' : '' ?>>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td><?= $row['created_at'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada laporan pengaduan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>