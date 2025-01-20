<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

include 'Back-End/Koneksi/koneksi.php';

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
$desa = mysqli_fetch_assoc($resultDesa);

// Query untuk mendapatkan data agama
$queryAgama = "SELECT agama_id, nama_agama FROM agama";
$resultAgama = mysqli_query($conn, $queryAgama);
$agama = mysqli_fetch_assoc($resultAgama);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dataAnggota.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sistem Informasi Desa</title>
</head>
<body>
    <style>

        .main{
            font-size: 11px !important;
        }
        
        .penduduk-detail {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 0 auto;
        }
        .penduduk-detail img {
            width: 150px;
            height: auto;
            border-radius: 8px;
            display: block;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
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
                    <a href="dashboard.php" style="text-decoration: none;">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <?php
                if ($role == 'admin') { ?>
                <li>
                    <a href="dataKlasifikasi.php" style="text-decoration: none;">
                        <span class="fa fa-users"></span>
                        <small>Data Klasifikasi</small>
                    </a>
                </li>
               
                <li>
                    <a href="dataPenduduk.php" class="active" style="text-decoration: none;">
                        <span class="fa fa-user"></span>
                        <small>Data Penduduk</small>
                    </a>
                </li>
                <?php } ?>
                <li>
                    <a href="BantuanSosial.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <?php
                if ($role == 'admin') { ?>
                <li>
                    <a href="laporan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan </small>
                    </a>
                </li>
                <li>
                    <a href="pendapatan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Pendapatan Desa</small>
                    </a>
                </li>
                <li>
                    <a href="potensi.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Potensi Desa</small>
                    </a>
                </li>
                <? } ?>
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
                        <b>Admin</b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="dtlAdmn.html">Profile</a></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            <table style="font-size: 12px;">
                <tr class="large-font">
                    <a href="dataPenduduk.php" style="color: black; text-decoration: none;">
                            <i class="fas fa-caret-left mr-2" style="color: #000000; font-size: 15px;"></i></a>
                    <b>DATA PENDUDUK</b></tr>
                <tr>
                  <tbody>
                    <tr style="height:25px;">
                        <td rowspan="7" width="250px">
                        <?php
                        if ($penduduk) {
                            $img_src = "Back-End/Uploads/foto_diri/" . $penduduk['foto_diri'];
                            echo "<img src='$img_src' alt='Foto Diri' width='250px'>";
                        } else {
                            echo "<p>Foto diri belum diunggah.</p>";
                        }
                        ?>
                    </td>
                      <td width="350px"><b>NIK</b></td>
                      <td><?php echo htmlspecialchars($penduduk['nik']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Nama</b></td>
                      <td><?php echo htmlspecialchars($penduduk['nama_lengkap']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Jenis Kelamin</b></td>
                      <td><?php echo htmlspecialchars($penduduk['jenis_kelamin']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Tempat, Tanggal Lahir</b></td>
                      <td><?php echo htmlspecialchars($penduduk['tempat_lahir']); ?>, <?php echo htmlspecialchars($penduduk['tanggal_lahir']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Agama</b></td>
                      <td><?php echo htmlspecialchars($agama['nama_agama']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Alamat</b></td>
                      <td><?php echo htmlspecialchars($desa['nama_daerah']); ?></td>
                    </tr>
                  </tbody>
            </table>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>