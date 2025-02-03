<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
include 'Back-End/Koneksi/koneksi.php';

if (isset($_GET['bantuan_id'])) {
    $bantuan_id = mysqli_real_escape_string($conn, $_GET['bantuan_id']);
    $query = "SELECT b.bantuan_id, b.nama_bantuan, b.jenis_bantuan, p.kk, p.nama_lengkap, p.jumlah_keluarga,  d.nama_daerah, b.foto_bukti 
              FROM bantuan b
              LEFT JOIN penduduk p ON b.penduduk_id = p.penduduk_id
              LEFT JOIN daerah d ON p.daerah_id = d.daerah_id
              WHERE b.bantuan_id = '$bantuan_id'";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) > 0) {
        $bantuan = mysqli_fetch_assoc($result);
    } else {
        die("<p>ID Bantuan tidak ditemukan.</p>");
    }
} else {
    die("<p>ID Bantuan tidak ditemukan di URL.</p>");
}

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
        .bantuan-detail {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 0 auto;
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
                        <small>Laporan </small>
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

        <main>
            <div class="bantuan-detail">
                <h2>Detail Bantuan Sosial</h2>
                <table>
                    <tr><td><b>Nama Bantuan</b></td><td><?php echo $bantuan['nama_bantuan']; ?></td></tr>
                    <tr><td><b>Jenis Bantuan</b></td><td><?php echo htmlspecialchars($bantuan['jenis_bantuan']); ?></td></tr>
                    <tr><td><b>KK Penerima</b></td><td><?php echo htmlspecialchars($bantuan['kk']); ?></td></tr>
                    <tr><td><b>Nama Penerima</b></td><td><?php echo htmlspecialchars($bantuan['nama_lengkap']); ?></td></tr>
                    <tr><td><b>Jumlah keluarga Penerima</b></td><td><?php echo htmlspecialchars($bantuan['jumlah_keluarga']); ?></td></tr>
                    <tr><td><b>Daerah Pemberian</b></td><td><?php echo htmlspecialchars($bantuan['nama_daerah']); ?></td></tr>
                    <tr><td><b>Foto Bukti</b></td><td><img src='uploads/<?php echo"{$bantuan['foto_bukti']}";?>' alt='Foto Bukti' width='100'></td></tr>
                </table>
            </div>
        </main>

        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Preview Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="previewFrame" src="" width="100%" height="500px" style="border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function setPreview(url) {
                // Setel atribut src iframe dengan URL yang diberikan
                const previewFrame = document.getElementById('previewFrame');
                previewFrame.src = url;
            }
        </script>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>