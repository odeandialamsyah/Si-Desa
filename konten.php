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
// Proses Create jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Judul = $_POST['judul'];
    $foto = $_FILES['photo']['name'];
    $foto_tmp = $_FILES['photo']['tmp_name'];
    $greeting  = $_POST['greeting'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    // Upload file ke folder "uploads"
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    move_uploaded_file($foto_tmp, "uploads/$foto");

    $stmt = $conn->prepare("INSERT INTO content (judul, photo, greeting , visi, misi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Judul, $foto, $greeting , $visi, $misi);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }

    $stmt->close();
    $conn->close();
}

$querykonten = 'SELECT * FROM content';
$resultkonten = mysqli_query($conn, $querykonten);
$konten = mysqli_fetch_assoc($resultkonten);
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
    <title>Sistem Informasi Desa</title>

    <style>
        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
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
            width: 100% !important; /* Memastikan grafik menyesuaikan lebar kontainer */
            height: auto !important; /* Memastikan grafik menyesuaikan tinggi kontainer */
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
                    <div class="profile-img bg-img" style="background-image: url('img/admn.jpg'); cursor: pointer; height: 100px; width: 100px; border-radius: 50%;"></div>
                </a>
                <h4 style="color: white; margin-top: 10px;"><b>Cindy Mala Puput</b></h4>
            </div>
        </div>
        <div class="side-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="active">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                    <li>
                        <a href="dataKlasifikasi.php">
                            <span class="fa fa-users"></span>
                            <small>Data Klasifikasi</small>
                        </a>
                    </li>
                    <li>
                        <a href="dataPenduduk.php">
                            <span class="fa fa-user"></span>
                            <small>Data Penduduk</small>
                        </a>
                    </li>
                <li>
                    <a href="BantuanSosial.php">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <li>
                    <a href="konten.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Konten</small>
                    </a>
                </li>
                    <li>
                        <a href="laporan.php">
                            <span class="fa fa-list-alt"></span>
                            <small>Laporan</small>
                        </a>
                    </li>
                    <li>
                        <a href="pendapatan.php">
                            <span class="fa fa-list-alt"></span>
                            <small>Pendapatan Desa</small>
                        </a>
                    </li>
                    <li>
                        <a href="potensi.php">
                            <span class="fa fa-list-alt"></span>
                            <small>Potensi Desa</small>
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
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(255, 255, 255);">
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
            <?php if(!$konten){ ?>
            <div class="container mt-3">
                <h2 class="text-center"><b>DASHBOARD</b></h2>
                <div class="container mt-5">
                    <h2 class="text-center">Tambah Sambutan, Visi, dan Misi</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama</label>
                            <textarea class="form-control" id="judul" name="judul" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="greeting " class="form-label">Sambutan</label>
                            <textarea class="form-control" id="greeting" name="greeting" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea class="form-control" id="visi" name="visi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control" id="misi" name="misi" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>              
            <?php }else { ?>
                <div class="d-flex flex-column align-items-center justify-content-center my-5 p-4 border rounded shadow-sm" style="max-width: 600px; margin: auto; background-color: #f8f9fa;">
                    <h4 class="text-center mb-3" style="font-weight: bold; color: #333;">Ganti Konten Landing Page</h4>
                    <p class="text-center mb-4" style="font-size: 16px; color: #555;">
                        Apakah Anda ingin mengganti konten landing page utama? Klik tombol di bawah untuk melanjutkan.
                    </p>
                    <a href="Back-End/delete_konten.php?content_id={$row['content_id']}" 
                    onclick="return confirm('Apakah Anda yakin ingin mengganti konten yang ada?')" 
                    class="btn btn-danger btn-lg px-5">
                        Ganti Landing Page
                    </a>
                </div>
            <?php } ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
