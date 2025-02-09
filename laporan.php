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
$query = "SELECT laporan.laporan_id, laporan.nama_pelapor, daerah.nama_daerah, daerah.jenis_daerah, laporan.laporan, laporan.foto_aduan, laporan.foto_hasil,laporan.status, laporan.created_at 
FROM
laporan
JOIN daerah ON laporan.daerah_id = daerah.daerah_id
ORDER BY laporan.created_at DESC;";

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
            margin-bottom: 20px;
            /* Tambahkan margin bawah untuk memberikan jarak antar table-container */
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
                    <a href="pengaduan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Pengaduan</small>
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
                <h2 class="text-center my-4"><b>Laporan Bantuan sosial</b></h2>
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
                            <th scope="col">Foto Bukti</th>
                            <th scope="col">Action</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'Back-End/Koneksi/koneksi.php';
                        $result = mysqli_query($conn, "
                            SELECT penduduk.kk, penduduk.nama_lengkap, daerah.nama_daerah, penduduk.jumlah_keluarga, bantuan.nama_bantuan, bantuan.jenis_bantuan, bantuan.status, bantuan.foto_bukti, bantuan.bantuan_id
FROM penduduk
JOIN daerah ON  penduduk.daerah_id = daerah.daerah_id
JOIN bantuan ON penduduk.user_id = bantuan.user_id
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
                                <td>";
                                if ($row['foto_bukti']) {
                                    echo "<img src='Back-End/uploads/{$row['foto_bukti']}' alt='Foto Bukti' width='100'>";
                                } elseif ($row['status'] == 'approved') {
                                    echo "
                                    <form action='Back-End/upload_foto_bukti.php' method='POST' enctype='multipart/form-data'>
                                        <input type='hidden' name='bantuan_id' value='{$row['bantuan_id']}'>
                                        <input type='file' name='foto_bukti' accept='image/*' required>
                                        <button type='submit' class='btn btn-success btn-sm mt-1'>Upload</button>
                                    </form>";
                                } else {
                                    echo "-";
                                }                                  
                                echo "</td>
                                <td>
                                    <form action='Back-End/update_status.php' method='POST'>
                                        <input type='hidden' name='bantuan_id' value='{$row['bantuan_id']}'>
                                        <select name='status' class='form-select' onchange='this.form.submit()'>
                                            <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='approved' " . ($row['status'] == 'approved' ? 'selected' : '') . ">Approved</option>
                                            <option value='rejected' " . ($row['status'] == 'rejected' ? 'selected' : '') . ">Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href='#' 
                                    class='btn-edit' 
                                        data-id='{$row['bantuan_id']}' 
                                        data-kk='{$row['kk']}' 
                                        data-nama='{$row['nama_lengkap']}' 
                                        data-daerah='{$row['nama_daerah']}' 
                                        data-jumlah='{$row['jumlah_keluarga']}' 
                                        data-bantuan='{$row['nama_bantuan']}' 
                                        data-jenis='{$row['jenis_bantuan']}' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#editModal'>
                                        <i class='fa-solid fa-pen-to-square mr-2' style='color: #e17833;'></i>
                                    </a>
                                    <a href='Back-End/delete_bantuan.php?bantuan_id={$row['bantuan_id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='text-danger'>
                                        <i class='fa-solid fa-trash mr-2'></i>
                                    </a>
                                    <a href='viewBantuanSosial.php?bantuan_id={$row['bantuan_id']}' style='text-decoration: none;'>
                                        <i class='fa-solid fa-eye mr-2' style='color: #2ad53e;'></i>
                                    </a>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="Back-End/export_pdf.php" method="post" class="mt-1">
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                </form>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>