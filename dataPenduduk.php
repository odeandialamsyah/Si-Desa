<?php
session_start();
// Memastikan user sudah login dan memiliki session yang valid
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan role dari session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
// Koneksi ke database
include 'Back-End/Koneksi/koneksi.php';

// Query untuk mengambil data desa
$queryDesa = "SELECT daerah_id, nama_daerah FROM daerah";
$resultDesa = mysqli_query($conn, $queryDesa);

// Validasi query desa
if (!$resultDesa) {
    die("Query desa gagal: " . mysqli_error($conn));
}
//query agama
$queryAgama = "SELECT DISTINCT agama_id, nama_agama FROM agama";
$resultAgama = mysqli_query($conn, $queryAgama);

// Validasi query agama
if (!$resultAgama) {
    die("Query agama gagal: " . mysqli_error($conn));
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

    .form-select.form-control {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        height: calc(2.25rem + 2px);
    }

    canvas {
        width: 100% !important;
        /* Memastikan grafik menyesuaikan lebar kontainer */
        height: auto !important;
        /* Memastikan grafik menyesuaikan tinggi kontainer */
    }

    /* .tabel-penduduk{
            margin: 6% 17%;
        } */
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
                    <span class="fa-solid fa-bars mt-3" style="color: rgb(255, 255, 255);"></span>
                </label>

                <div class="dropdown">
                    <span><i class="fa-solid fa-user mr-1" style="color: rgb(255, 255, 255);"></i></span>
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color: rgb(255, 255, 255);">
                        <b>Admin</b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php">Profile</a></li>
                        <li><a class="dropdown-item" href="Back-End/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main class="container">
            <table>
                <tr class="large-font">
                    <td colspan="7" style="text-align: center; border:0px !important">
                        <h2><b>DATA PENDUDUK</b></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" style="text-align: right;  border:0px !important">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendapatanModal">
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
                            <th scope="col">Jumlah Anggota Keluarga</th>
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
                                <a href='#' class='btn btn-warning btn-sm btn-edit' 
                                data-bs-toggle='modal' 
                                data-bs-target='#editPendudukModal' 
                                data-id='{$row['nik']}' 
                                data-kk='{$row['kk']}' 
                                data-nama='{$row['nama_lengkap']}'
                                data-jenis_kelamin='{$row['jenis_kelamin']}'
                                data-tempat_lahir='{$row['tempat_lahir']}'
                                data-tanggal_lahir='{$row['tanggal_lahir']}'
                                data-pekerjaan='{$row['pekerjaan']}'
                                data-gaji='{$row['gaji']}'
                                data-jumlah_keluarga='{$row['jumlah_keluarga']}'
                                data-daerah='{$row['daerah_id']}'
                                data-foto='{$row['foto_diri']}'
                                data-filekk='{$row['file_kk']}'
                                data-filenik='{$row['file_nik']}'>
                                edit
                                </a>
                                <a href='Back-End/delete_penduduk.php?nik={$row['nik']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");' class='btn btn-danger btn-sm'>
                                    delete
                                </a>
                                <a href='viewDataPenduduk.php?nik={$row['nik']}' class='btn btn-primary btn-sm'>
                                    view
                                </a>
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

        <div class="modal fade" id="addPendapatanModal" tabindex="-1" aria-labelledby="addPendapatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPendapatanModalLabel">Tambah Data Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddPendapatan" method="POST" action="Back-End/proses_tambah_penduduk.php" enctype="multipart/form-data">
                            <div class="row">
                                <!-- KK -->
                                <div class="mb-3 col-md-6">
                                    <label for="kk" class="form-label">KK</label>
                                    <input type="text" class="form-control" id="kk" name="kk" required>
                                </div>

                                <!-- NIK -->
                                <div class="mb-3 col-md-6">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nama Lengkap -->
                                <div class="mb-3 col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dropdown Desa -->
                                <div class="mb-3 col-md-6">
                                    <label for="daerah_id" class="form-label">Kampung</label>
                                    <select class="form-select form-control" id="daerah_id" name="daerah_id" required>
                                        <option value="" disabled selected>Pilih Kampung</option>
                                        <?php
                                        // Loop data desa
                                        while ($row = mysqli_fetch_assoc($resultDesa)) {
                                            echo '<option value="' . $row['daerah_id'] . '">' . $row['nama_daerah'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Agama -->
                                <div class="mb-3 col-md-6">
                                    <label for="agama_id" class="form-label">Agama</label>
                                    <select class="form-select form-control" id="agama_id" name="agama_id" onchange="toggleAgamaLainnya(this)" required>
                                        <option value="" disabled selected>Pilih Agama</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($resultAgama)) {
                                            echo '<option value="' . $row['agama_id'] . '">' . $row['nama_agama'] . '</option>';
                                        }
                                        ?>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control mt-2" id="inputAgamaLainnya" name="agama_lainnya" placeholder="Masukkan Nama Agama" style="display: none;">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Tanggal Lahir -->
                                <div class="mb-3 col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="mb-3 col-md-6">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Pekerjaan -->
                                <div class="mb-3 col-md-6">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                </div>

                                <!-- Gaji -->
                                <div class="mb-3 col-md-6">
                                    <label for="gaji" class="form-label">Gaji/Bulan</label>
                                    <input type="number" class="form-control" id="gaji" name="gaji" step="0.01" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Jumlah Keluarga -->
                                <div class="mb-3 col-md-6">
                                    <label for="jumlah_keluarga" class="form-label">Jumlah Anggota Keluarga</label>
                                    <input type="number" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" required>
                                </div>

                                <!-- Input Foto Diri -->
                                <div class="mb-3 col-md-6">
                                    <label for="foto_diri" class="form-label">Foto Diri</label>
                                    <input type="file" class="form-control" id="foto_diri" name="foto_diri" accept="image/*" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="file_kk" class="form-label">Dokumen KK</label>
                                    <input type="file" class="form-control" name="file_kk" id="file_kk" accept=".pdf,.doc,.docx" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="file_nik" class="form-label">Dokumen KTP</label>
                                    <input type="file" class="form-control" name="file_nik" id="file_nik" accept=".pdf,.doc,.docx" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>

                    <script>
                        function toggleAgamaLainnya(select) {
                            const inputAgamaLainnya = document.getElementById('inputAgamaLainnya');
                            if (select.value === 'lainnya') {
                                inputAgamaLainnya.style.display = 'block';
                                inputAgamaLainnya.required = true;
                            } else {
                                inputAgamaLainnya.style.display = 'none';
                                inputAgamaLainnya.required = false;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editPendudukModal" tabindex="-1" aria-labelledby="editPendudukModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPendudukModalLabel">Edit Data Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditPenduduk" method="POST" action="Back-End/update_penduduk.php" enctype="multipart/form-data">
                            <input type="hidden" id="editNik" name="nik">
                            <input type="hidden" id="editKk" name="kk">

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editNamaLengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="editNamaLengkap" name="nama_lengkap" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select form-control" id="editJenisKelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editDaerah" class="form-label">Daerah</label>
                                    <select class="form-select form-control" id="editDaerah" name="daerah_id">
                                        <option value="">Pilih Daerah</option>
                                        <?php
                                        mysqli_data_seek($resultDesa, 0); // Reset pointer untuk loop ulang
                                        while ($row = mysqli_fetch_assoc($resultDesa)) {
                                            echo '<option value="' . $row['daerah_id'] . '">' . $row['nama_daerah'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editTempatLahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="editTempatLahir" name="tempat_lahir" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editTanggalLahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="editTanggalLahir" name="tanggal_lahir" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editPekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="editPekerjaan" name="pekerjaan">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editGaji" class="form-label">Gaji</label>
                                    <input type="number" class="form-control" id="editGaji" name="gaji">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editJumlahKeluarga" class="form-label">Jumlah Keluarga</label>
                                    <input type="number" class="form-control" id="editJumlahKeluarga" name="jumlah_keluarga">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editFotoDiri" class="form-label">Foto Diri</label>
                                    <input type="file" class="form-control" id="editFotoDiri" name="foto_diri" accept="image/*">
                                    <img id="previewFotoDiri" src="" alt="Foto Diri" class="img-thumbnail mt-2" style="max-height: 150px;">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editFileKK" class="form-label">File Kartu Keluarga (KK)</label>
                                    <input type="file" class="form-control" id="editFileKK" name="file_kk" accept=".pdf">
                                    <a id="previewFileKK" href="#" target="_blank" class="d-block mt-2">Lihat File KK</a>
                                    <small id="fileKKMessage" class="text-danger d-none">File KK tidak ditemukan!</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editFileNIK" class="form-label">File KTP (NIK)</label>
                                    <input type="file" class="form-control" id="editFileNIK" name="file_nik" accept=".pdf">
                                    <a id="previewFileNIK" href="#" target="_blank" class="d-block mt-2">Lihat File NIK</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

        document.getElementById('file_nik').addEventListener('change', function() {
            const allowedTypes = ['pdf', 'doc', 'docx'];
            const file = this.files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedTypes.includes(fileExtension)) {
                alert('Hanya file PDF, DOC, atau DOCX yang diperbolehkan untuk NIK!');
                this.value = ''; // Reset input
            }
        });

        document.getElementById('file_kk').addEventListener('change', function() {
            const allowedTypes = ['pdf', 'doc', 'docx'];
            const file = this.files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedTypes.includes(fileExtension)) {
                alert('Hanya file PDF, DOC, atau DOCX yang diperbolehkan untuk KK!');
                this.value = ''; // Reset input
            }
        });


        // document.getElementById('formAddPenduduk').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     // Simulate form submission
        //     alert('Data penduduk berhasil ditambahkan!');
        //     // Close the modal
        //     var modal = bootstrap.Modal.getInstance(document.getElementById('addPendudukModal'));
        //     modal.hide();
        // });
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#editPendudukModal');

                // Ambil data dari atribut tombol
                modal.querySelector('#editNik').value = this.dataset.id;
                modal.querySelector('#editKk').value = this.dataset.kk;
                modal.querySelector('#editNamaLengkap').value = this.dataset.nama;
                modal.querySelector('#editJenisKelamin').value = this.dataset.jenis_kelamin;
                modal.querySelector('#editTempatLahir').value = this.dataset.tempat_lahir;
                modal.querySelector('#editTanggalLahir').value = this.dataset.tanggal_lahir;
                modal.querySelector('#editPekerjaan').value = this.dataset.pekerjaan;
                modal.querySelector('#editGaji').value = this.dataset.gaji;
                modal.querySelector('#editJumlahKeluarga').value = this.dataset.jumlah_keluarga;
                modal.querySelector('#editDaerah').value = this.dataset.daerah;

                // Path untuk file
                const fotoDiri = this.dataset.foto;
                const fileKK = this.dataset.filekk;
                const fileNIK = this.dataset.filenik;

                const fotoDiriPath = `Back-End/uploads/foto_diri/${fotoDiri}`;
                const fileKKPath = `Back-End/uploads/file_kk/${fileKK}`;
                const fileNIKPath = `Back-End/uploads/file_nik/${fileNIK}`;

                // Load preview
                modal.querySelector('#previewFotoDiri').src = fotoDiriPath;
                modal.querySelector('#previewFileKK').href = fileKKPath;
                modal.querySelector('#previewFileNIK').href = fileNIKPath;
            });
        });
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