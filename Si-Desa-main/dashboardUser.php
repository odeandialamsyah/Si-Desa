<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dan user_id dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($role != 'user') {
    header("Location: dashboard.php"); // Redirect ke dashboard admin jika bukan user
    exit();
}

// Pastikan user_id ada
if (!$user_id) {
    echo "<script>alert('Kesalahan: User ID tidak ditemukan.'); window.location.href='login.php';</script>";
    exit();
}

include 'Back-End/Koneksi/koneksi.php';

// Query untuk mengecek apakah user sudah memiliki data penduduk
$queryPenduduk = "SELECT * FROM penduduk WHERE user_id = '$user_id'";
$resultPenduduk = mysqli_query($conn, $queryPenduduk);
$penduduk = mysqli_fetch_assoc($resultPenduduk);

?>
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
                <div class="profile-img bg-img" style="background-image: url('img/ftC1.jpg');"></div>
                <h4 style="color: white;"><b>Nama Pengguna</b></h4>
            </div>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="#" class="active" style="text-decoration: none;">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="profil.php" style="text-decoration: none;">
                        <span class="fa fa-user"></span>
                        <small>Profil</small>
                    </a>
                </li>
                <li>
                    <?php if (!$penduduk): ?>
                        <a href="#" style="text-decoration: none;" onclick="alert('Data penduduk tidak ditemukan. Silakan perbarui data Anda di halaman profil.'); return false;">
                            <span class="fa fa-info-circle"></span>
                            <small>Bantuan Sosial</small>
                        </a>
                    <?php else: ?>
                        <a href="bantuan.php" style="text-decoration: none;">
                            <span class="fa fa-info-circle"></span>
                            <small>Bantuan Sosial</small>
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (!$penduduk): ?>
                        <a href="#" style="text-decoration: none;" onclick="alert('Data penduduk tidak ditemukan. Silakan perbarui data Anda di halaman profil.'); return false;">
                            <span class="fa fa-info-circle"></span>
                            <small>Bantuan Sosial Kelompok</small>
                        </a>
                    <?php else: ?>
                        <a href="bantuan_kelompok.php" style="text-decoration: none;">
                            <span class="fa fa-info-circle"></span>
                            <small class="text-left">Bantuan Sosial Kelompok</small>
                        </a>
                    <?php endif; ?>
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
            <table>
                <tr class="large-font">
                    <td colspan="7" style="text-align: center;">
                        <h2><b>Dashboard User</b></h2>
                    </td>
                </tr>
            </table>

            <div class="container mt-3">
                <!-- Container untuk informasi user -->
                <div class="row">
                    <div class="col-md-4 mb-3 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                Informasi Profil
                            </div>
                            <div class="card-body d-flex">
                                <?php if (!$penduduk): ?>
                                    <p>Perbarui data diri Anda di halaman profil.</p>
                                <?php else: ?>
                                    <p>Data diri Anda telah lengkap, terima kasih telah menggunakan layanan kami.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxBantuan = document.getElementById('bantuanChart').getContext('2d');
        new Chart(ctxBantuan, {
            type: 'bar',
            data: {
                labels: ['Bantuan A', 'Bantuan B', 'Bantuan C'],
                datasets: [{
                    label: 'Jumlah Bantuan',
                    data: [10, 5, 15],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>