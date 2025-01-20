<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
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
        .form-container {
            width: 50%; /* Set lebar menjadi 50% */
            margin: 0 auto; /* Tengah secara horizontal */
            padding: 20px; /* Tambahkan padding untuk estetika */
            border: 1px solid #ccc; /* Opsional: Tambahkan border */
            border-radius: 10px; /* Opsional: Tambahkan border-radius */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Opsional: Tambahkan bayangan */
            background-color: #f9f9f9; /* Opsional: Tambahkan warna latar */
        }
        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
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
                <?php
                 if ($role == 'admin') {  ?>
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
                <?php } ?>
                <li>
                    <a href="BantuanSosial.php" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <?php
                 if ($role == 'admin') {  ?>
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
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="fa-solid fa-bars mt-3" style="color: #fff;"></span>
                </label>
                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: #fff;"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: #fff;">
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
            <div class="container">
                <h2 class="text-center my-4"><b>YANG TELAH MENERIMA BANTUAN SOSIAL</b></h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah penerima bantuan
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
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'Back-End/Koneksi/koneksi.php';
                        $result = mysqli_query($conn, "
    SELECT b.*, p.kk, p.nama_lengkap, p.jumlah_keluarga, d.nama_daerah 
    FROM bantuan b
    LEFT JOIN penduduk p ON b.penduduk_id = p.penduduk_id
    LEFT JOIN daerah d ON p.daerah_id = d.daerah_id
");

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
                                <td>
                                    <a href='Back-End/update_bantuan.php?bantuan_id={$row['bantuan_id']}' onclick='return confirm(\"Apakah Anda yakin ingin mengedit data ini?\") class='text-danger'>
                                        <i class='fa-solid fa-pen-to-square mr-2' style='color: #e17833;'></i>
                                    </a>
                                    <a href='Back-End/delete_bantuan.php?bantuan_id={$row['bantuan_id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='text-danger'>
                                        <i class='fa-solid fa-trash mr-2'></i>
                                    </a>
                                    <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;' data-bs-toggle='modal' data-bs-target='#modal1'></i>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Modal Tambah Bantuan -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penerima Bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="Back-End/proses_tambah_bantuan.php"  method="POST">
                            <div class="mb-3">
                                <label for="penduduk_id" class="form-label">Nomor KK</label>
                                <select name="penduduk_id" id="penduduk_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Nomor KK</option>
                                    <?php
                                    $query = "SELECT penduduk_id, kk, nama_lengkap FROM penduduk";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['penduduk_id']}'>{$row['kk']} - {$row['nama_lengkap']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                    value="<?= isset($selectedPenduduk['nama_lengkap']) ? $selectedPenduduk['nama_lengkap'] : ''; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_daerah" class="form-label">Nama Daerah</label>
                                <input type="text" class="form-control" id="nama_daerah" name="nama_daerah" 
                                    value="<?= isset($selectedPenduduk['nama_daerah']) ? $selectedPenduduk['nama_daerah'] : ''; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                                <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" 
                                    value="<?= isset($selectedPenduduk['jumlah_keluarga']) ? $selectedPenduduk['jumlah_keluarga'] : ''; ?>" readonly>
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
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('penduduk_id').addEventListener('change', function() {
        var penduduk_id = this.value;

        // Periksa jika penduduk_id tidak kosong
        if (penduduk_id) {
            // Menggunakan fetch untuk membuat request AJAX
            fetch('Back-End/get_penduduk_data.php?penduduk_id=' + penduduk_id)
                .then(response => response.json())
                .then(data => {
                    // Isi field dengan data yang diterima
                    document.getElementById('nama_lengkap').value = data.nama_lengkap || '';
                    document.getElementById('nama_daerah').value = data.nama_daerah || '';
                    document.getElementById('jumlah_keluarga').value = data.jumlah_keluarga || '';
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    });
</script>

</body>
</html>
