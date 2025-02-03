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
            width: 50%;
            /* Set lebar menjadi 50% */
            margin: 0 auto;
            /* Tengah secara horizontal */
            padding: 20px;
            /* Tambahkan padding untuk estetika */
            border: 1px solid #ccc;
            /* Opsional: Tambahkan border */
            border-radius: 10px;
            /* Opsional: Tambahkan border-radius */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Opsional: Tambahkan bayangan */
            background-color: #f9f9f9;
            /* Opsional: Tambahkan warna latar */
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
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
            <div class="container">
                <h4 class="text-center mt-5"><b>TABEL AJUAN BANTUAN SOSIAL</b></h4>
                <a href="bantuan_kelompok_daftar_admin.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-primary mb-3">
                        Ajukan bantuan
                    </button>
                </a>
                <table class="table table-striped">
                    <thead style="background-color: #D9D9D9;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nomor Kelompok</th>
                            <th scope="col">Nama Bantuan</th>
                            <th scope="col">Jenis Bantuan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'Back-End/Koneksi/koneksi.php';
                        // Dapatkan user_id dari session
                        $user_id = $_SESSION['user_id'];

                        // Query untuk menampilkan data bantuan sesuai baatch_id
                        $result = mysqli_query($conn, "
                            SELECT DISTINCT bu.batch_id, bk.*
                            FROM bantuan_kelompok bk
                            LEFT JOIN batch_users bu ON bk.bantuan_kelompok_id = bu.batch_id;
                        ");
                        // Query untuk mengecek apakah user sudah memiliki
                        $querybantuan = "SELECT * FROM bantuan_kelompok bk LEFT JOIN batch_users bu ON bk.bantuan_kelompok_id = bu.batch_id";
                        $resultbantuan = mysqli_query($conn, $querybantuan);
                        $bantuan = mysqli_fetch_assoc($resultbantuan);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                                <tr>
                                    <td>" . $no++ . "</td>
                                    <td>{$row['bantuan_kelompok_id']}</td>
                                    <td>{$row['nama_bantuan']}</td>
                                    <td>{$row['jenis_bantuan']}</td>
                                    <td>
                                    <form action='Back-End/update_status_kelompok.php' method='POST'>
                                        <input type='hidden' name='bantuan_kelompok_id' value='{$row['bantuan_kelompok_id']}'>
                                        <select name='status' class='form-select' onchange='this.form.submit()'>
                                            <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='approved' " . ($row['status'] == 'approved' ? 'selected' : '') . ">Approved</option>
                                            <option value='rejected' " . ($row['status'] == 'rejected' ? 'selected' : '') . ">Rejected</option>
                                        </select>
                                    </form>
                                    </td>
                                    <td>
                                        <a href='bantuan_kelompok_detail_admin.php?id={$row['bantuan_kelompok_id']}' style='text-decoration: none;'>
                                            <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;'></i>
                                        </a>
                                        <a href='bantuan_kelompok_edit_admin.php?id={$row['bantuan_kelompok_id']}' style='text-decoration: none;'>
                                            <i class='fa-solid fa-pen-to-square mr-2' style='color: #e17833;'></i>
                                        </a>
                                        <a href='Back-End/delete_bantuan_kelompok.php?bantuan_kelompok_id={$row['bantuan_kelompok_id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='text-danger'>
                                            <i class='fa-solid fa-trash mr-2'></i>
                                        </a>
                                    </td>
                                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>