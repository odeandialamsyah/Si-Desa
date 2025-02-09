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
// Ambil data daerah dari tabel daerah
$daerahQuery = "SELECT daerah_id, nama_daerah, jenis_daerah FROM daerah";
$daerahResult = $conn->query($daerahQuery);

// Query untuk mengecek apakah user sudah memiliki
$queryPenduduk = "SELECT * FROM penduduk WHERE user_id = '$user_id'";
$resultPenduduk = mysqli_query($conn, $queryPenduduk);
$penduduk = mysqli_fetch_assoc($resultPenduduk);

$sql = "SELECT l.*, d.nama_daerah 
        FROM laporan l 
        JOIN daerah d ON l.daerah_id = d.daerah_id 
        WHERE l.user_id = '$user_id' 
        ORDER BY l.created_at DESC";
$result = $conn->query($sql);

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
                <li>
                    <a href="createLaporan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan</small>
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
            <!-- Modal -->
            <div class="modal fade" id="tambahLaporanModal" tabindex="-1" role="dialog" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahLaporanModalLabel">Formulir Pengaduan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Isi formulir berikut untuk menyampaikan pengaduan Anda.</p>

                            <?php if (!empty($successMessage)): ?>
                                <div class="alert alert-success"><?= $successMessage ?></div>
                            <?php endif; ?>
                            <?php if (!empty($errorMessage)): ?>
                                <div class="alert alert-danger"><?= $errorMessage ?></div>
                            <?php endif; ?>

                            <form method="POST" action="Back-End/proses_tambah_laporan.php" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="form-group">
                                    <label for="nama_pelapor">Nama Pelapor</label>
                                    <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" required>
                                </div>
                                <div class="form-group">
                                    <label for="daerah_id">Daerah</label>
                                    <select class="form-control" id="daerah_id" name="daerah_id" required>
                                        <option value="" disabled selected>Pilih Daerah</option>
                                        <?php while ($row = $daerahResult->fetch_assoc()): ?>
                                            <option value="<?= $row['daerah_id'] ?>">
                                                <?= $row['nama_daerah'] ?> (<?= $row['jenis_daerah'] ?>)
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="laporan">Laporan</label>
                                    <textarea class="form-control" id="laporan" name="laporan" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto_aduan">Foto Aduan</label>
                                    <input type="file" class="form-control-file" id="foto_aduan" name="foto_aduan" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Kirim Laporan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mt-5 w-75">
                <!-- Button to trigger the modal -->
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahLaporanModal">
                    Tambah Laporan
                </button>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelapor</th>
                            <th>Daerah</th>
                            <th>Laporan</th>
                            <th>Foto Aduan</th>
                            <th>Foto Tindakan</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_pelapor']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_daerah']) ?></td>
                                    <td><?= htmlspecialchars($row['laporan']) ?></td>
                                    <td>
                                        <?php if ($row['foto_aduan']): ?>
                                            <img src="Back-End/<?= $row['foto_aduan'] ?>" alt="Foto Aduan" style="max-width: 100px; height: auto;">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['foto_hasil']): ?>
                                            <img src="Back-End/uploads/fotohasil/<?= $row['foto_hasil'] ?>" alt="Foto Hasil" style="max-width: 100px; height: auto;">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($row['status'] == "pending") {
                                                echo "<span class='badge badge-warning'>Pending</span>";
                                            } elseif ($row['status'] == "approved") {
                                                echo "<span class='badge badge-success'>Diterima</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>Ditolak</span>";
                                            }
                                        ?>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data laporan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
    <!-- Include Bootstrap JS and jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
