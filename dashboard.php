<?php
session_start();
// Periksa apakah cookie 'email' masih aktif
if (!isset($_COOKIE['email'])) {
    // Jika cookie habis, hapus session dan arahkan ke login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Periksa apakah session masih ada (antisipasi manual logout)
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
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
                    <a href="laporan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan</small>
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
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <table>
                <tr class="large-font">
                    <td colspan="7" style="text-align: center;">
                        <h2><b>DASHBOARD</b></h2>
                    </td>
                </tr>
            </table>

            <div class="container mt-3">
                <!-- Container untuk grafik bersebelahan -->
                <div class="row">
                    <div class="col-md-4 mb-3 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                Grafik Jumlah Warga Berdasarkan Klasifikasi
                            </div>
                            <div class="card-body">
                                <canvas id="klasifikasiChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                Grafik Data Dokumen Penduduk
                            </div>
                            <div class="card-body">
                                <canvas id="dokumenChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                Grafik Data Agama
                            </div>
                            <div class="card-body">
                                <canvas id="agamaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script type="text/javascript" src="index.js"></script>
<script type="text/javascript" src="dataAnggota.js"></script>

<script>
    const ctxKlasifikasi = document.getElementById('klasifikasiChart').getContext('2d');
    new Chart(ctxKlasifikasi, {
        type: 'bar',
        data: {
            labels: ['Anak-anak', 'Remaja', 'Dewasa', 'Lansia'],
            datasets: [{
                label: 'Jumlah Warga',
                data: [120, 150, 200, 80],
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

    const ctxDokumen = document.getElementById('dokumenChart').getContext('2d');
    new Chart(ctxDokumen, {
        type: 'pie',
        data: {
            labels: ['KTP', 'KK', 'IJAZAH', 'SKCK'],
            datasets: [{
                label: 'Persentase Dokumen',
                data: [30, 25, 20, 25],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    const ctxAgama = document.getElementById('agamaChart').getContext('2d');
    new Chart(ctxAgama, {
        type: 'doughnut',
        data: {
            labels: ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'],
            datasets: [{
                label: 'Jumlah Warga Berdasarkan Agama',
                data: [50, 20, 15, 10, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>

    </div>
</body>
</html>
