<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

include 'Back-End/Koneksi/koneksi.php';
// Proses Create jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Judul = $_POST['judul'];
    $foto = $_FILES['photo']['name'];
    $foto_tmp = $_FILES['photo']['tmp_name'];
    $greeting  = $_POST['greeting'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    // Upload file ke folder "uploads"
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    move_uploaded_file($foto_tmp, "uploads/$foto");

    $stmt = $conn->prepare("INSERT INTO content (judul, photo, greeting , visi, misi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Judul, $foto, $greeting, $visi, $misi);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }

    $stmt->close();
    $conn->close();
}

$querykonten = 'SELECT * FROM content';
$resultkonten = mysqli_query($conn, $querykonten);
$konten = mysqli_fetch_assoc($resultkonten);


// Ambil data dari tabel laporan
$query = "SELECT nama_pendapatan, tanggal_dibuat, gambar_pendapatan
          FROM pendapatan_desa
          ORDER BY tanggal_dibuat DESC";

$result = $conn->query($query);

if (isset($_GET['potensi_id'])) {
    $potensi_id = $_GET['potensi_id'];

    // Ambil data dari database
    $query = "SELECT potensi_id, nama_pariwisata, create_at
              FROM potensi_desa
              WHERE potensi_id = '$potensi_id'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result); // Ambil hasil query dalam bentuk array
}
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
            /* Memastikan grafik menyesuaikan lebar kontainer */
            height: auto !important;
            /* Memastikan grafik menyesuaikan tinggi kontainer */
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
                    <div class="profile-img bg-img" style="background-image: url('img/admn.jpg'); cursor: pointer; height: 100px; width: 100px; border-radius: 50%;"></div>
                </a>
                <h4 style="color: white; margin-top: 10px;"><b>Cindy Mala Puput</b></h4>
            </div>
        </div>
        <div class="side-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="active">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="dataKlasifikasi.php">
                        <span class="fa fa-users"></span>
                        <small>Data Klasifikasi</small>
                    </a>
                </li>
                <li>
                    <a href="dataPenduduk.php">
                        <span class="fa fa-user"></span>
                        <small>Data Penduduk</small>
                    </a>
                </li>
                <li>
                    <a href="BantuanSosial.php">
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
                    <a href="laporan.php">
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
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(255, 255, 255);">
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
            <?php if (!$konten) { ?>
                <div class="container mt-3">
                    <h2 class="text-center"><b>DASHBOARD</b></h2>
                    <div class="container mt-5">
                        <h2 class="text-center">Tambah Sambutan, Visi, dan Misi</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="photo" name="photo" required>
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Nama</label>
                                <textarea class="form-control" id="judul" name="judul" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="greeting " class="form-label">Sambutan</label>
                                <textarea class="form-control" id="greeting" name="greeting" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="visi" class="form-label">Visi</label>
                                <textarea class="form-control" id="visi" name="visi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="misi" class="form-label">Misi</label>
                                <textarea class="form-control" id="misi" name="misi" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex flex-column align-items-center justify-content-center my-5 p-4 border rounded shadow-sm" style="max-width: 600px; margin: auto; background-color: #f8f9fa;">
                    <h4 class="text-center mb-3" style="font-weight: bold; color: #333;">Ganti Konten Landing Page</h4>
                    <p class="text-center mb-4" style="font-size: 16px; color: #555;">
                        Apakah Anda ingin mengganti konten landing page utama? Klik tombol di bawah untuk melanjutkan.
                    </p>
                    <a href="Back-End/delete_konten.php?content_id={$row['content_id']}"
                        onclick="return confirm('Apakah Anda yakin ingin mengganti konten yang ada?')"
                        class="btn btn-danger btn-lg px-5">
                        Ganti Landing Page
                    </a>
                </div>
            <?php } ?>
            <div class="table-container">
                <h2 class="text-center my-4"><b>Pendapatan Desa</b></h2>
                <tr>
                    <td colspan="7" style="text-align: right;  border:0px !important">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addPendapatanModal">
                            Tambah Pendapatan
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
                            $img_src = "Back-End/" . $row['gambar_pendapatan'];
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
            <div class="table-container">
                <h2 class="text-center my-4"><b>Potensi Desa</b></h2>
                <tr>
                    <td colspan="7" style="text-align: right;  border:0px !important">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addPotensiModal">
                            Tambah Potensi
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
                        include 'Back-End/Koneksi/koneksi.php';

                        // Ambil data dari tabel potensi_desa di database
                        $result = mysqli_query($conn, "SELECT * FROM potensi_desa");
                        if (!$result) {
                            die("Query error: " . mysqli_error($conn));
                        }

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img_src = "Back-End/" . $row['gambar_pariwisata'];
                            echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>{$row['nama_pariwisata']}</td>
                                <td>{$row['create_at']}</td>
                                <td><img src='$img_src' alt='gambar pariwisata' width='50px'></td>
                                <td>
                                    <!-- Tombol Update -->
                                    <button 
                                        class='btn btn-warning btn-sm' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#editModal'
                                        onclick='populateEditModal(" . json_encode($row) . ")'>
                                        Edit
                                    </button>
                                    
                                    <!-- Tombol Hapus -->
                                    <a href='Back-End/delete_potensi.php?potensi_id={$row['potensi_id']}' 
                                    onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' 
                                    class='btn btn-danger btn-sm'>
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
        <div class="modal fade" id="addPendapatanModal" tabindex="-1" aria-labelledby="addPendapatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPendudukModalLabel">Tambah Data Pendapatan</h5>
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
                        <h5 class="modal-title" id="updateModalLabel">Update Pendapatan Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="Back-End/update_pendapatan.php" enctype="multipart/form-data">
                            <input type="hidden" id="pendapatan_id_edit" name="pendapatan_id">

                            <!-- Nama Potensi Desa -->
                            <div class="mb-3">
                                <label for="nama_pendapatan_edit" class="form-label">Nama Pendapatan Desa</label>
                                <input type="text" class="form-control" id="nama_pendapatan_edit" name="nama_pendapatan" required>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="tanggal_dibuat_edit" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_dibuat_edit" name="tanggal_dibuat" required>
                            </div>

                            <!-- Input Gambar -->
                            <div class="mb-3">
                                <label for="gambar_pendapatan_edit" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar_pendapatan_edit" name="gambar_pendapatan">
                                <small id="current_gambar"></small>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addPotensiModal" tabindex="-1" aria-labelledby="addPotensiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPotensiModalLabel">Tambah Data Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddPenduduk" method="POST" action="Back-End/proses_tambah_pariwisata.php" enctype="multipart/form-data">

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama_pariwisata" class="form-label">Nama Potensi Desa</label>
                                <input type="text" class="form-control" id="nama_pariwisata" name="nama_pariwisata" required>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="create_at" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="create_at" name="create_at" required>
                            </div>

                            <!-- Input Foto Diri -->
                            <div class="mb-3">
                                <label for="gambar_pariwisata" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar_pariwisata" name="gambar_pariwisata" accept="image/*" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Potensi Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="Back-End/update_potensi.php" enctype="multipart/form-data">
                            <input type="hidden" id="potensi_id_edit" name="potensi_id">

                            <!-- Nama Potensi Desa -->
                            <div class="mb-3">
                                <label for="nama_pariwisata" class="form-label">Nama Potensi Desa</label>
                                <input type="text" class="form-control" id="nama_pariwisata_edit" name="nama_pariwisata" required>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="create_at" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="create_at_edit" name="create_at" required>
                            </div>

                            <!-- Input Gambar -->
                            <div class="mb-3">
                                <label for="gambar_pariwisata" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar_pariwisata" name="gambar_pariwisata">
                                <small id="current_gambars"></small>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
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
            document.getElementById('pendapatan_id_edit').value = data.pendapatan_id;
            document.getElementById('nama_pendapatan_edit').value = data.nama_pendapatan;
            document.getElementById('tanggal_dibuat_edit').value = data.tanggal_dibuat;

            // Preview gambar jika ada
            const gambarPreview = document.getElementById('current_gambar');
            gambarPreview.innerHTML = `<a href="Back-End/${data.gambar_pendapatan}" target="_blank">Lihat Gambar</a>`;
        }

        function populateEditModal(data){
             // Mengisi data dari parameter ke form modal update
             document.getElementById('potensi_id_edit').value = data.potensi_id;
            document.getElementById('nama_pariwisata_edit').value = data.nama_pariwisata;
            document.getElementById('create_at_edit').value = data.create_at;

            // Preview gambar jika ada
            const gambarPreview = document.getElementById('current_gambars');
            gambarPreview.innerHTML = `<a href="Back-End/${data.gambar_pariwisata}" target="_blank">Lihat Gambar</a>`;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>