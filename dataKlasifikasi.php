<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Sistem Informasi Desa</title>

</head>


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
        /* Memastikan grafik menyesuaikan lebar kontainer */
        height: auto !important;
        /* Memastikan grafik menyesuaikan tinggi kontainer */
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
                        <small class="text-left">Data Klasifikasi</small>
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
                    <span class="fa-solid fa-bars mt-3" style="color: rgb(255, 255, 255);"></span>
                </label>

                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: rgb(255, 255, 255);"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: rgb(255, 255, 255);">
                        <b>Admin</b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php">Profile</a></li>
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main class="container">
            <table class="">
                <tr class="large-font">
                    <td colspan="7" style="text-align: center;">
                        <h2><b>DATA KLASIFIKASI</b></h2>
                    </td>
                </tr>

                <tr style="background-color: #D9D9D9;">
                    <th scope="col">No</th>
                    <th scope="col">Klasifikasi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Range Umur</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    include 'Back-End/Koneksi/koneksi.php';

                    // Query untuk mendapatkan jumlah berdasarkan klasifikasi usia
                    $query = "
                        SELECT 
                            CASE 
                                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 12 THEN 'Anak-anak'
                                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 17 THEN 'Remaja'
                                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 59 THEN 'Dewasa'
                                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60 THEN 'Lanjut Usia'
                                ELSE 'Tidak Diketahui'
                            END AS klasifikasi_usia,
                            COUNT(*) AS jumlah
                        FROM 
                            penduduk
                        GROUP BY klasifikasi_usia;
                    ";
                    $result = mysqli_query($conn, $query);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$data['klasifikasi_usia']}</td>
                            <td>{$data['jumlah']}</td>
                            <td>";

                        // Menampilkan range umur berdasarkan klasifikasi
                        if ($data['klasifikasi_usia'] == 'Anak-anak') {
                            echo "0 - 12 Tahun";
                        } elseif ($data['klasifikasi_usia'] == 'Remaja') {
                            echo "13 - 17 Tahun";
                        } elseif ($data['klasifikasi_usia'] == 'Dewasa') {
                            echo "18 - 59 Tahun";
                        } elseif ($data['klasifikasi_usia'] == 'Lanjut Usia') {
                            echo "60 Tahun ke atas";
                        }
                        echo "</td></tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="dataAnggota.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>

</html>