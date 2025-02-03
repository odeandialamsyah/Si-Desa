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
            <?php if ($penduduk['gaji'] < 1500000) { ?>
                <!-- Jika memenuhi syarat -->
                <h2 class="text-center ml-5 mt-3">Selamat, Anda memenuhi syarat untuk mengajukan bantuan sosial.</h2>
            <?php } else { ?>
                <p class="ml-5 mt-3">Anda tidak memenuhi syarat untuk mengajukan bantuan, karena gaji anda di atas rata-rata.</p>
            <?php } ?>

            <?php if ($penduduk['gaji'] < 1500000) { ?>
                <div class="container">
                    <h4 class="text-center mt-5"><b>TABEL AJUAN BANTUAN SOSIAL</b></h4>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajukan bantuan
                    </button>
                    <table class="table table-striped">
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor KK</th>
                                <th scope="col">Nama Kepala Keluarga</th>
                                <th scope="col">RT / RW</th>
                                <th scope="col">Jumlah Keluarga</th>
                                <th scope="col">Bantuan</th>
                                <th scope="col">Jenis Bantuan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'Back-End/Koneksi/koneksi.php';
                            // Dapatkan user_id dari session
                            $user_id = $_SESSION['user_id'];

                            // Query untuk menampilkan data bantuan sesuai user_id
                            $result = mysqli_query($conn, "
                            SELECT b.*, p.kk, p.nama_lengkap, p.jumlah_keluarga, d.nama_daerah 
                            FROM bantuan b
                            LEFT JOIN penduduk p ON b.penduduk_id = p.penduduk_id
                            LEFT JOIN daerah d ON p.daerah_id = d.daerah_id
                            WHERE b.user_id = $user_id
                        ");
                            // Query untuk mengecek apakah user sudah memiliki
                            $querybantuan = "SELECT * FROM bantuan WHERE user_id = '$user_id'";
                            $resultbantuan = mysqli_query($conn, $querybantuan);
                            $bantuan = mysqli_fetch_assoc($resultbantuan);

                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                            <tr>
                                <td>" . $no++ . "</td>
                                <td>{$row['kk']}</td>
                                <td>{$row['nama_lengkap']}</td>
                                <td>{$row['nama_daerah']}</td>
                                <td>{$row['jumlah_keluarga']}</td>
                                <td>{$row['nama_bantuan']}</td>
                                <td>{$row['jenis_bantuan']}</td>
                                <td>";
                                if ($bantuan['status'] == 'pending') {
                                    echo "<button class='btn btn-warning btn-sm'>Pending</button>";
                                } elseif ($bantuan['status'] == 'rejected') {
                                    echo "<button class='btn btn-danger btn-sm'>Rejected</button>";
                                } elseif ($bantuan['status'] == 'approved') {
                                    echo "<button class='btn btn-success btn-sm'>Accepted</button>";
                                }
                                echo "</td>

                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
            <?php } ?>
            <!-- Modal Ajukan Bantuan -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penerima Bantuan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="Back-End/proses_tambah_bantuan_user.php" method="POST">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>"> <!-- Kirim user_id -->
                                <div class="mb-3">
                                    <label for="search_kk" class="form-label">Nomor KK</label>
                                    <input type="text" class="form-control" id="search_kk" placeholder="Ketik Nomor KK atau Nama...">
                                    <input type="hidden" id="penduduk_id" name="penduduk_id">
                                    <div class="list-group" id="search_results" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_daerah" class="form-label">Nama Daerah</label>
                                    <input type="text" class="form-control" id="nama_daerah" name="nama_daerah" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                                    <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_bantuan" class="form-label">Nama Bantuan</label>
                                    <input type="text" class="form-control" id="nama_bantuan" name="nama_bantuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                    <select class="form-control" id="jenis_bantuan" name="jenis_bantuan" required>
                                        <option value="Uang Tunai">Uang Tunai</option>
                                        <option value="Barang">Barang</option>
                                        <option value="Jasa">Jasa</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Bantuan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search_kk').on('keyup', function() {
                const query = $(this).val().trim(); // Ambil teks yang diketik

                if (query.length > 0) {
                    $.ajax({
                        url: 'Back-End/search_kk.php', // Endpoint pencarian
                        type: 'GET',
                        data: {
                            q: query
                        }, // Kirim parameter pencarian
                        success: function(data) {
                            const results = JSON.parse(data);
                            let html = '';

                            if (results.length > 0) {
                                // Render hasil pencarian
                                results.forEach(item => {
                                    html += `
                                        <a href="#" class="list-group-item list-group-item-action" 
                                        data-id="${item.id}" 
                                        data-kk="${item.kk}" 
                                        data-nama="${item.nama_lengkap}" 
                                        data-daerah="${item.nama_daerah}" 
                                        data-jumlah="${item.jumlah_keluarga}">
                                        ${item.kk} - ${item.nama_lengkap}
                                        </a>`;
                                });
                            } else {
                                html = '<div class="list-group-item">Tidak ada hasil ditemukan.</div>';
                            }

                            $('#search_results').html(html).show();
                        },
                        error: function() {
                            $('#search_results').html('<div class="list-group-item">Terjadi kesalahan.</div>').show();
                        }
                    });
                } else {
                    $('#search_results').hide();
                }
            });

            // Pilih hasil pencarian
            $(document).on('click', '#search_results .list-group-item', function(e) {
                e.preventDefault();

                const pendudukId = $(this).data('id');
                const namaLengkap = $(this).data('nama');
                const namaDaerah = $(this).data('daerah');
                const jumlahKeluarga = $(this).data('jumlah');

                // Isi form dengan data yang dipilih
                $('#penduduk_id').val(pendudukId);
                $('#search_kk').val($(this).data('kk'));
                $('#nama_lengkap').val(namaLengkap);
                $('#nama_daerah').val(namaDaerah);
                $('#jumlah_keluarga').val(jumlahKeluarga);

                // Sembunyikan hasil pencarian
                $('#search_results').hide();
            });

            // Sembunyikan hasil pencarian jika klik di luar
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search_kk, #search_results').length) {
                    $('#search_results').hide();
                }
            });
        });
    </script>
</body>

</html>