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

// Query untuk mengecek apakah user sudah memiliki
$queryPenduduk = "SELECT * FROM penduduk WHERE user_id = '$user_id'";
$resultPenduduk = mysqli_query($conn, $queryPenduduk);
$penduduk = mysqli_fetch_assoc($resultPenduduk);

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
                <div class="profile-img bg-img" style="background-image: url('img/ftC1.jpg');"></div>
                <h4 style="color: white;"><b>Nama Pengguna</b></h4>
            </div>
        </div>
        <div class="side-menu">
            <ul>
                <li>
                    <a href="dashboardUser.php" class="active" style="text-decoration: none;">
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
                    <a href="bantuan.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <li>
                    <a href="bantuan_kelompok.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small class="text-left">Bantuan Sosial Kelompok</small>
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
            <?php if ($penduduk['gaji'] < 1500000) { ?>
                <!-- Jika memenuhi syarat -->
                <h2 class="text-center ml-5 mt-3">Selamat, Anda memenuhi syarat untuk mengajukan bantuan sosial Kelompok.</h2>
            <?php } else { ?>
                <p class="ml-5 mt-3">Anda tidak memenuhi syarat untuk mengajukan bantuan, karena gaji anda di atas rata-rata.</p>
            <?php } ?>

            <?php if ($penduduk['gaji'] < 1500000) { ?>
                <div class="container">
                    <h4 class="text-center mt-5"><b>TABEL AJUAN BANTUAN SOSIAL</b></h4>
                    <a href="bantuan_kelompok_daftar.php" style="text-decoration: none;">
                        <button type="button" class="btn btn-primary mb-3">
                            Ajukan bantuan
                        </button>
                    </a>
                    <table class="table table-striped">
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Kelompok</th>
                                <th scope="col">Nama Bantuan</th>
                                <th scope="col">Jenis Bantuan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'Back-End/Koneksi/koneksi.php';
                            // Dapatkan user_id dari session
                            $user_id = $_SESSION['user_id'];

                            // Query untuk menampilkan data bantuan sesuai user_id
                            $result = mysqli_query($conn, "
                            SELECT bk.*
                            FROM bantuan_kelompok bk
                            LEFT JOIN batch_users bu ON bk.bantuan_kelompok_id = bu.batch_id
                            WHERE bu.user_id = $user_id
                        ");
                            // Query untuk mengecek apakah user sudah memiliki
                            $querybantuan = "SELECT * FROM bantuan_kelompok bk LEFT JOIN batch_users bu ON bk.bantuan_kelompok_id = bu.batch_id WHERE bu.user_id = '$user_id'";
                            $resultbantuan = mysqli_query($conn, $querybantuan);
                            $bantuan = mysqli_fetch_assoc($resultbantuan);

                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <tr>
                                    <td>" . $no++ . "</td>
                                    <td>{$row['bantuan_kelompok_id']}</td>
                                    <td>{$row['nama_bantuan']}</td>
                                    <td>{$row['jenis_bantuan']}</td>
                                    <td>";
                                if ($row['status'] == 'pending') {
                                    echo "<button class='btn btn-warning btn-sm'>Pending</button>";
                                } elseif ($row['status'] == 'rejected') {
                                    echo "<button class='btn btn-danger btn-sm'>Rejected</button>";
                                } elseif ($row['status'] == 'approved') {
                                    echo "<button class='btn btn-success btn-sm'>Accepted</button>";
                                }
                                echo "</td>
                                <td>
                                    <a href='bantuan_kelompok_detail.php?id={$row['bantuan_kelompok_id']}' style='text-decoration: none;'>
                                        <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;'></i>
                                    </a>
                                </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
            <?php } ?>


        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>

</body>

</html>