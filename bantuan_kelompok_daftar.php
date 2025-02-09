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
                        <small class="d-flex ml-2">Bantuan Sosial Kelompok</small>
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
            <div class="container mt-5">
                <h2 class="text-center">Tambah Data Bantuan Sosial Kelompok</h2>
                <form id="kkForm" action="Back-End/proses_tambah_bantuan_user_kelompok.php" method="POST">
                    <div id="kkInputContainer">
                        <div class="mb-3">
                            <label for="kkNumber1" class="form-label">Nomor KK 1</label>
                            <input type="text" class="form-control kk-input" id="kkNumber1" name="kkNumber[]" placeholder="Masukkan Nomor KK" required>

                            <input type="hidden" name="userIDUser[]" class="hidden-user-id">

                            <div class="owner-name" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                            <div class="owner-user-id" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
                            <div class="list-group search-results" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-3" id="addKKButton">Tambah Nomor KK</button>
                    <div class="mb-3">
                        <label for="nama_bantuan" class="form-label">Nama Bantuan</label>
                        <input type="text" class="form-control" id="nama_bantuan" name="nama_bantuan" placeholder="Masukkan Nama Bantuan" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                        <select class="form-control" id="jenis_bantuan" name="jenis_bantuan" required>
                            <option value="Uang Tunai">Uang Tunai</option>
                            <option value="Barang">Barang</option>
                            <option value="Jasa">Jasa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>

    <!-- input KK -->
    <script>
        $(document).ready(function() {
            const kkInputContainer = $('#kkInputContainer');
            let kkCount = 1;

            $('#addKKButton').on('click', function() {
                kkCount++;
                const newKKField = `
        <div class="mb-3 kk-group">
            <label for="kkNumber${kkCount}" class="form-label">Nomor KK </label>
            <input type="text" class="form-control kk-input" id="kkNumber" name="kkNumber[]" placeholder="Masukkan Nomor KK" required>
            <input type="hidden" name="userIDUser[]" class="hidden-user-id">
            <div class="owner-name" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
            <div class="owner-user-id" style="margin-top: 5px; color: #333; font-weight: bold;"></div>
            <div class="list-group search-results" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
            <button type="button" class="btn btn-danger btn-sm removeKKButton mt-2">Hapus</button>
        </div>`;

                kkInputContainer.append(newKKField);
            });

            // Event listener untuk menghapus input KK yang ditambahkan
            $(document).on('click', '.removeKKButton', function() {
                $(this).closest('.kk-group').remove();
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
</body>

</html>