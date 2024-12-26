<?php
    // Koneksi ke database
    include 'Back-End/Koneksi/koneksi.php';

    // Query untuk mengambil data desa
    $queryDesa = "SELECT daerah_id, nama_daerah FROM daerah";
    $resultDesa = mysqli_query($conn, $queryDesa);

    // Validasi query desa
    if (!$resultDesa) {
        die("Query desa gagal: " . mysqli_error($conn));
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
    </div>
<main>
    <table>
        <tr class="large-font">
            <td colspan="7" style="text-align: center; border:0px !important">
                <h2><b>DATA PENDUDUK</b></h2>
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right;  border:0px !important">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendudukModal">
                    Tambah Penduduk
                </button>
            </td>
        </tr>
        <table class="table table-hover">
            <thead style="background-color: #D9D9D9;">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tempat, Tanggal Lahir</th>
                    <th scope="col">Riwayat pekerjaan</th>
                    <th scope="col">gaji/bulan</th>
                    <th scope="col">Jumlah Keluarga</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data dari tabel penduduk di database
                include 'Back-End/Koneksi/koneksi.php';
                $result = mysqli_query($conn, "SELECT * FROM penduduk");
                $totalGaji = 0;
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalGaji += $row['gaji'];
                    echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>{$row['nik']}</td>
                    <td>{$row['nama_lengkap']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['tempat_lahir']}, {$row['tanggal_lahir']}</td>
                    <td>{$row['pekerjaan']}</td>
                    <td>Rp." . number_format($row['gaji'], 0, ',', '.') . "</td>
                    <td>{$row['jumlah_keluarga']}</td>
                    <td>
                        <a href='Back-End/update_penduduk.php?nik={$row['nik']}' class='fa-solid fa-pen-to-square mr-2' style='color: #e17833;'></a>
                        <a href='Back-End/delete_penduduk.php?nik={$row['nik']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='text-danger'>
                            <i class='fa-solid fa-trash mr-2'></i>
                        </a>
                        <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;'></i>
                    </td>
                </tr>";
                }
                ?>
        </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">Pendapatan Rata-rata</td>
                    <td colspan="4">Rp.
                        <?php 
                            // Cek apakah $no lebih dari 1 (ada data)
                            if ($no > 1) {
                                echo number_format($totalGaji / ($no - 1), 0, ',', '.'); 
                            } else {
                                echo '0'; // Tampilkan 0 jika tidak ada data
                            }
                        ?> perbulan
                    </td>
                </tr>
            </tfoot>
        </table>
        </tr>
    </table>
</main>

<div class="modal fade" id="addPendudukModal" tabindex="-1" aria-labelledby="addPendudukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPendudukModalLabel">Tambah Data Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddPenduduk" method="POST" action="Back-End/proses_tambah_penduduk.php">
                    <!-- KK -->
                    <div class="mb-3">
                        <label for="kk" class="form-label">KK</label>
                        <input type="text" class="form-control" id="kk" name="kk" required>
                    </div>

                    <!-- NIK -->
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Dropdown Desa -->
                    <div class="mb-3">
                        <label for="daerah_id" class="form-label">Desa</label>
                        <select class="form-select" id="daerah_id" name="daerah_id" required>
                            <option value="">Pilih Desa</option>
                            <?php
                            // Loop data desa
                            while ($row = mysqli_fetch_assoc($resultDesa)) {
                                echo '<option value="' . $row['daerah_id'] . '">' . $row['nama_daerah'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                    </div>

                    <!-- Gaji -->
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji/Bulan</label>
                        <input type="number" class="form-control" id="gaji" name="gaji" step="0.01" required>
                    </div>

                    <!-- Jumlah Keluarga -->
                    <div class="mb-3">
                        <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                        <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function redirectToDetail(url) {
        window.location.href = url;
    }
</script>
<script>
    function redirectToDetail(url) {
        window.location.href = url;
    }

    // document.getElementById('formAddPenduduk').addEventListener('submit', function(event) {
    //     event.preventDefault();
    //     // Simulate form submission
    //     alert('Data penduduk berhasil ditambahkan!');
    //     // Close the modal
    //     var modal = bootstrap.Modal.getInstance(document.getElementById('addPendudukModal'));
    //     modal.hide();
    // });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="index.js"></script>
<script type="text/javascript" src="dataAnggota.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</div>
</body>

</html>