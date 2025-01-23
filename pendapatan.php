<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

// Include file koneksi
include 'Back-End/Koneksi/koneksi.php';

// Ambil data dari tabel laporan
$query = "SELECT nama_pendapatan, tanggal_dibuat, gambar_pendapatan
          FROM pendapatan_desa
          ORDER BY tanggal_dibuat DESC";

$result = $conn->query($query);
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
    <title>Laporan Pengaduan</title>
    <style>
        .main-content {
            margin-left: 250px;
            /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
        }

        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: auto;
            max-width: 90%;
        }

        .table-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .table-container table {
            margin: auto;
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
                    <span class="fa-solid fa-bars mt-3" style="color: #fff;"></span>
                </label>
                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: #fff;"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: #fff;">
                        <b>Admin</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php">Profile</a></li>
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div class="table-container">
                <h2 class="text-center my-4"><b>Potensi Desa</b></h2>
                <tr>
                    <td colspan="7" style="text-align: right;  border:0px !important">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendudukModal">
                            Tambah Penduduk
                        </button>
                    </td>
                </tr>
                <table class="table table-striped">
                    <thead style="background-color: #D9D9D9;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pendapatan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Ambil data dari tabel penduduk di database
                        include 'Back-End/Koneksi/koneksi.php';
                        $result = mysqli_query($conn, "SELECT * FROM pendapatan_desa");
                        if (!$result) {
                            die("Query error: " . mysqli_error($conn));
                        }
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img_src ="Back-End/" . $row['gambar_pendapatan'];
                            echo "<tr>
                            <td>" . $no++ . "</td>
                            <td>{$row['nama_pendapatan']}</td>
                            <td>{$row['tanggal_dibuat']}</td>
                            <td><img src='$img_src' alt='gambar pendapatan' width='50px'></td>
                            <td>
                                 <!-- Tombol Update -->
                                <button 
                                    class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#updateModal'
                                    onclick='populateUpdateModal(" . json_encode($row) . ")'>
                                    Edit
                                </button>
                                <a href='Back-End/delete_pendapatan.php?pendapatan_id={$row['pendapatan_id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='btn btn-danger btn-sm'>
                                    Delete
                                </a>
                            </td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="modal fade" id="addPendudukModal" tabindex="-1" aria-labelledby="addPendudukModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPendudukModalLabel">Tambah Data Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddPenduduk" method="POST" action="Back-End/proses_tambah_pendapatan.php" enctype="multipart/form-data">

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Pendapatan</label>
                                <input type="text" class="form-control" id="nama_pendapatan" name="nama_pendapatan" required>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggal_dibuat" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" required>
                            </div>

                            <!-- Input Foto Diri -->
                            <div class="mb-3">
                                <label for="foto_diri" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar_pendapatan" name="gambar_pendapatan" accept="image/*" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Potensi Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="Back-End/update_pendapatan.php" enctype="multipart/form-data">
                            <input type="hidden" id="pendapatan_id" name="pendapatan_id">

                            <!-- Nama Potensi Desa -->
                            <div class="mb-3">
                                <label for="nama_pendapatan" class="form-label">Nama Potensi Desa</label>
                                <input type="text" class="form-control" id="nama_pendapatan" name="nama_pendapatan" required>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="create_at" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" required>
                            </div>

                            <!-- Input Gambar -->
                            <div class="mb-3">
                                <label for="gambar_pendapatan" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar_pendapatan" name="gambar_pendapatan">
                                <small id="current_gambar"></small>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
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
    function populateUpdateModal(data) {
    // Mengisi data dari parameter ke form modal update
    document.getElementById('pendapatan_id').value = data.pendapatan_id;
    document.getElementById('nama_pendapatan').value = data.nama_pendapatan;
    document.getElementById('tanggal_dibuat').value = data.tanggal_dibuat;

    // Preview gambar jika ada
    const gambarPreview = document.getElementById('current_gambar');
    gambarPreview.innerHTML = `<a href="Back-End/${data.gambar_pendapatan}" target="_blank">Lihat Gambar</a>`;
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="index.js"></script>
<script type="text/javascript" src="dataAnggota.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>