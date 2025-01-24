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

// Query untuk menggabungkan penduduk dengan daerah dan agama
$queryPenduduk = "SELECT penduduk.*, daerah.nama_daerah, agama.nama_agama FROM penduduk
    LEFT JOIN daerah ON penduduk.daerah_id = daerah.daerah_id
    LEFT JOIN agama ON penduduk.agama_id = agama.agama_id
    WHERE 
        penduduk.user_id = '$user_id'
";
$resultPenduduk = mysqli_query($conn, $queryPenduduk);

// Validasi query penduduk
if (!$resultPenduduk) {
    die("Query penduduk gagal: " . mysqli_error($conn));
}

// Fetch hasil join
$penduduk = mysqli_fetch_assoc($resultPenduduk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="dataAnggota.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
</body>
</html>
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
        <?php if (!$penduduk): ?>
        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div class="card shadow">
                        <h4 class="mb-0 mt-4">Isi Data Penduduk</h5>
                            <div class="card-body">
                                <form action="Back-End/proses_tambah_penduduk_user.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>"> <!-- Kirim user_id -->
                                    
                                    <div class="mb-3">
                                        <label for="kk" class="form-label d-flex">KK</label>
                                        <input type="text" class="form-control" name="kk" id="kk" placeholder="Masukkan Nomor KK" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="nik" class="form-label d-flex">NIK</label>
                                        <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan Nomor NIK" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label d-flex">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label d-flex">Jenis Kelamin</label>
                                        <select class="form-select d-flex" name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="daerah_id" class="form-label d-flex">Kampung</label>
                                        <select class="form-select d-flex" id="daerah_id" name="daerah_id" required>
                                            <option value="">Pilih kampung</option>
                                            <?php
                                            // Loop data desa
                                            while ($row = mysqli_fetch_assoc($resultDesa)) {
                                                echo '<option value="' . $row['daerah_id'] . '">' . $row['nama_daerah'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="agama_id" class="form-label d-flex">Agama</label>
                                        <select class="form-select d-flex" id="agama_id" name="agama_id" required>
                                            <option value="">Pilih agama</option>
                                            <?php
                                            // Loop data desa
                                            while ($row = mysqli_fetch_assoc($resultAgama)) {
                                                echo '<option value="' . $row['agama_id'] . '">' . $row['nama_agama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label d-flex">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label d-flex">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label d-flex">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gaji" class="form-label d-flex">Gaji/Bulan</label>
                                        <input type="number" class="form-control" id="gaji" name="gaji" step="0.01" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_keluarga" class="form-label d-flex">Jumlah Keluarga</label>
                                        <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="foto_diri" class="form-label d-flex">Foto Diri</label>
                                        <input type="file" class="form-control" name="foto_diri" id="foto_diri" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file_kk" class="form-label d-flex">Dokumen KK</label>
                                        <input type="file" class="form-control" name="file_kk" id="file_kk" accept=".pdf,.doc,.docx" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file_nik" class="form-label d-flex">Dokumen KTP</label>
                                        <input type="file" class="form-control" name="file_nik" id="file_nik" accept=".pdf,.doc,.docx" required>
                                    </div>

                                    
                                    <button type="submit" class="btn btn-primary w-40 d-flex">Simpan Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <?php else: ?>
        <main>
            <table style="font-size: 12px;">
                <tr class="large-font">
                    <a href="profil.php" style="color: black; text-decoration: none;">
                            <i class="fas fa-caret-left mr-2" style="color: #000000; font-size: 15px;"></i></a>
                    <b>DATA PENDUDUK</b></tr>
                <tr>
                <tbody>
                    <tr style="height:25px;">
                        <td rowspan="7" width="250px">
                        <?php
                        if ($penduduk) {
                            $img_src = "Back-End/Uploads/foto_diri/" . $penduduk['foto_diri'];
                            echo "<img src='$img_src' alt='Foto Diri' width='250px'>";
                        } else {
                            echo "<p>Foto diri belum diunggah.</p>";
                        }
                        ?>
                    </td>
                    <td width="350px"><b>NIK</b></td>
                    <td><?php echo htmlspecialchars($penduduk['nik']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                    <td><b>Nama</b></td>
                    <td><?php echo htmlspecialchars($penduduk['nama_lengkap']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                    <td><b>Jenis Kelamin</b></td>
                    <td><?php echo htmlspecialchars($penduduk['jenis_kelamin']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                    <td><b>Tempat, Tanggal Lahir</b></td>
                    <td><?php echo htmlspecialchars($penduduk['tempat_lahir']); ?>, <?php echo htmlspecialchars($penduduk['tanggal_lahir']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                    <td><b>Agama</b></td>
                    <td><?php echo htmlspecialchars($penduduk['nama_agama']); ?></td>
                    </tr>
                    <tr style="height:25px;">
                    <td><b>Alamat</b></td>
                    <td><?php echo htmlspecialchars($penduduk['nama_daerah']); ?></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tr class="large-font"><b>DATA DOKUMEN</b></tr>
                <tr>
                    <table class="table table-striped">
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Dokumen</th>
                                <th scope="col">Jenis Dokumen</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>E-KTP</td>
                                <td>Identitas</td>
                                <td>
                                    <?php
                                    if ($penduduk) {
                                        $file_srcktp = "Back-End/Uploads/file_nik/" . $penduduk['file_nik'];
                                        echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#previewModal' onclick='setPreview(\"$file_srcktp\")'>Preview</button>";
                                    } else {
                                        echo "<p>Dokumen E-KTP belum diunggah.</p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>KK</td>
                                <td>Kartu Keluarga</td>
                                <td>
                                <?php
                                    if ($penduduk) {
                                        $file_srckk = "Back-End/Uploads/file_kk/" . $penduduk['file_kk'];
                                        echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#previewModal' onclick='setPreview(\"$file_srckk\")'>Preview</button>";
                                    } else {
                                        echo "<p>Dokumen KK belum diunggah.</p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
            </table>                   
        </main>
        <?php endif; ?>
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
    </div>

    <script>
        function setPreview(url) {
            // Setel atribut src iframe dengan URL yang diberikan
            const previewFrame = document.getElementById('previewFrame');
            previewFrame.src = url;
        }
    </script>

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
