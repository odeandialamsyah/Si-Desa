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
                <li>
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
            <main>
                <div class="container mt-5">
                    <h2>Edit Data Bantuan Kelompok</h2>
                    <?php if (!empty($dataDetailBantuan)): ?>
                        <!-- Form untuk mengedit data -->
                        <form action="Back-End/update_bantuan_kelompok.php" method="POST">
                            <!-- Input hidden untuk menyimpan ID Bantuan -->
                            <input type="hidden" name="bantuan_kelompok_id" value="<?= $bantuan_kelompok_id; ?>">

                            <!-- Input untuk kk baru -->
                            <!-- <div id="kkInputContainer">
                                <div class="mb-3">
                                    <label for="kkNumber1" class="form-label">Nomor KK 1</label>
                                    <input type="text" class="form-control kk-input" id="kkNumber1" name="kkNumber[]" placeholder="Masukkan Nomor KK" required>

                                    <input type="hidden" name="userIDUser[]" class="hidden-user-id">

                                    <div class="owner-name" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                                    <div class="owner-user-id" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                                    <div class="list-group search-results" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-3" id="addKKButton">Tambah Nomor KK</button> -->

                            <!-- Nama Bantuan -->
                            <div class="mb-3">
                                <label for="nama_bantuan" class="form-label">Nama Bantuan</label>
                                <input type="text" class="form-control" id="nama_bantuan" name="nama_bantuan"
                                    value="<?= htmlspecialchars($dataDetailBantuan[0]['nama_bantuan']); ?>" required>
                            </div>

                            <!-- Jenis Bantuan -->
                            <div class="mb-3">
                                <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                <select class="form-control" id="jenis_bantuan" name="jenis_bantuan" required>
                                    <option value="Uang Tunai" <?= $dataDetailBantuan[0]['jenis_bantuan'] == 'Uang Tunai' ? 'selected' : ''; ?>>Uang Tunai</option>
                                    <option value="Barang" <?= $dataDetailBantuan[0]['jenis_bantuan'] == 'Barang' ? 'selected' : ''; ?>>Barang</option>
                                    <option value="Jasa" <?= $dataDetailBantuan[0]['jenis_bantuan'] == 'Jasa' ? 'selected' : ''; ?>>Jasa</option>
                                </select>
                            </div>


                            <!-- Status Bantuan -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Bantuan</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" <?= $dataDetailBantuan[0]['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="approved" <?= $dataDetailBantuan[0]['status'] === 'approved' ? 'selected' : ''; ?>>Approved</option>
                                    <option value="rejected" <?= $dataDetailBantuan[0]['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="mb-3">
                                <label for="created_at" class="form-label">Tanggal Dibuat</label>
                                <input type="text" class="form-control" id="created_at"
                                    value="<?= htmlspecialchars($dataDetailBantuan[0]['created_at']); ?>" disabled>
                            </div>


                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="bantuan_kelompok.php" class="btn btn-secondary">Batal</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">Data tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </main>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>

    <!-- Input KK -->
    <!-- 
    <script>
        $(document).ready(function() {
            const kkInputContainer = $('#kkInputContainer');
            let kkCount = 1;

            $('#addKKButton').on('click', function() {
                kkCount++;
                const newKKField = `
                <div class="mb-3">
                <label for="kkNumber${kkCount}" class="form-label">Nomor KK ${kkCount}</label>
                <input type="text" class="form-control kk-input" id="kkNumber${kkCount}" name="kkNumber[]" placeholder="Masukkan Nomor KK" required>
                
                <input type="hidden" name="userIDUser[]" class="hidden-user-id">

                <div class="owner-name" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                <div class="owner-user-id" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                <div class="list-group search-results" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
                </div>`;
                kkInputContainer.append(newKKField);
            });

            $(document).on('keyup', '.kk-input', function() {
                const query = $(this).val().trim();
                const resultContainer = $(this).closest('.mb-3').find('.search-results');
                const ownerNameDiv = $(this).closest('.mb-3').find('.owner-name');

                if (query.length > 0) {
                    $.ajax({
                        url: 'Back-End/search_kk.php',
                        type: 'GET',
                        data: {
                            q: query
                        },
                        success: function(data) {
                            const results = JSON.parse(data);
                            let html = '';

                            if (results.length > 0) {
                                results.forEach(item => {
                                    html += `
                                <a href="#" class="list-group-item list-group-item-action" 
                                    data-kk="${item.kk}" 
                                    data-owner="${item.nama_lengkap}" 
                                    data-user_id="${item.user_id}">
                                    ${item.kk} - ${item.nama_lengkap}
                                </a>`;
                                });
                            } else {
                                html = '<div class="list-group-item">Tidak ada hasil ditemukan.</div>';
                            }

                            resultContainer.html(html).show();
                        },
                        error: function() {
                            resultContainer.html('<div class="list-group-item">Terjadi kesalahan.</div>').show();
                        }
                    });
                } else {
                    resultContainer.hide();
                    ownerNameDiv.text(''); // Clear owner name if input is empty
                }
            });

            $(document).on('click', '.list-group-item', function(e) {
                e.preventDefault();
                const kkValue = $(this).data('kk');
                const ownerName = $(this).data('owner');
                const userIDUser = $(this).data('user_id'); // Get user_id

                const parentDiv = $(this).closest('.mb-3');
                parentDiv.find('.kk-input').val(kkValue); // Set KK number
                parentDiv.find('.owner-name').text(`Nama : ${ownerName}`); // Display owner's name
                parentDiv.find('.owner-user-id').text(`User ID: ${userIDUser}`); // Display user_id
                parentDiv.find('.hidden-user-id').val(userIDUser); // Update hidden input
                $(this).closest('.search-results').hide();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.kk-input, .search-results').length) {
                    $('.search-results').hide();
                }
            });
        });
    </script>
     -->
</body>

</html>