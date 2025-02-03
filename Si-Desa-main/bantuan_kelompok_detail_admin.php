<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dan user_id dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admin';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($role != 'admin') {
    header("Location: dashboard.php"); // Redirect ke dashboard admin jika bukan user
    exit();
}

// Pastikan user_id ada
if (!$user_id) {
    echo "<script>alert('Kesalahan: User ID tidak ditemukan.'); window.location.href='login.php';</script>";
    exit();
}

include 'Back-End/Koneksi/koneksi.php';

// Query untuk mengecek apakah user sudah memiliki
$queryPenduduk = "SELECT * FROM penduduk WHERE user_id = '$user_id'";
$resultPenduduk = mysqli_query($conn, $queryPenduduk);
$penduduk = mysqli_fetch_assoc($resultPenduduk);

if (isset($_GET['id'])) {
    $bantuan_kelompok_id = $_GET['id'];
} else {
    // Jika id tidak ada, redirect atau tampilkan pesan error
    echo "<script>alert('ID Bantuan Kelompok tidak ditemukan.'); window.location.href='bantuan_kelompok.php';</script>";
    exit();
}

$queryDetailBantuan = "
    SELECT *
    FROM bantuan_kelompok bk
    LEFT JOIN batch_users bu ON bk.bantuan_kelompok_id = bu.batch_id
    LEFT JOIN penduduk p ON bu.user_id = p.user_id
    WHERE bk.bantuan_kelompok_id = $bantuan_kelompok_id
";
$resultDetailBantuan = mysqli_query($conn, $queryDetailBantuan);

// Simpan semua baris data ke dalam array
$dataDetailBantuan = [];
while ($row = mysqli_fetch_assoc($resultDetailBantuan)) {
    $dataDetailBantuan[] = $row;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dataAnggota.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Dashboard User</title>
    <style>
        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .card-header {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
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
                <!-- Bungkus gambar dengan tag <a> -->
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
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="fa-solid fa-bars mt-3" style="color: rgb(255, 255, 255);"></span>
                </label>
                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: rgb(255, 255, 255);"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: rgb(255, 255, 255);">
                        <b>User</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div style="display:inline;">
                <?php
                if (!empty($dataDetailBantuan)) {
                    // Extract general aid information from the first row
                    $firstRow = $dataDetailBantuan[0];
                    echo "
                        <div>Nama Bantuan: {$firstRow['nama_bantuan']}</div>
                        <div>Jenis Bantuan: {$firstRow['jenis_bantuan']}</div>
                        <div>Status: {$firstRow['status']}</div>
                        ";
                } else {
                    echo "<p>Data bantuan tidak ditemukan.</p>";
                }
                ?>
            </div>

            <?php
            if (!empty($dataDetailBantuan)) {
                echo "<table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>Foto Diri</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>KK</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Pekerjaan</th>
                        <th>Gaji</th>
                        <th>Jumlah Keluarga</th>
                    </tr>
                </thead>
                <tbody>";
                foreach ($dataDetailBantuan as $row) {

                    echo "<tr>
                    <td>
                        <img src='Back-End/Uploads/foto_diri/" . $row['foto_diri'] . "' alt='Foto Diri' height='150px'>
                    </td>
                    <td>{$row['nama_lengkap']}</td>
                    <td>{$row['nik']}</td>
                    <td>{$row['kk']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['tanggal_lahir']}</td>
                    <td>{$row['tempat_lahir']}</td>
                    <td>{$row['pekerjaan']}</td>
                    <td>{$row['gaji']}</td>
                    <td>{$row['jumlah_keluarga']}</td>
                </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Tidak ada data yang ditemukan.</p>";
            }
            ?>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>

</body>

</html>