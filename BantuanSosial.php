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
                <li>
                    <a href="pengaduan.php" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Pengaduan</small>
                    </a>
                </li>
                <li>
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
                        <form action="Back-End/proses_tambah_bantuan.php" method="POST">
                            <!-- <div class="mb-3">
                                <label for="penduduk_id" class="form-label">Nomor KK</label>
                                <select name="penduduk_id" id="penduduk_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Nomor KK</option>
                                    <?php
                                    // $query = "SELECT penduduk_id, kk, nama_lengkap FROM penduduk";
                                    // $result = $conn->query($query);
                                    // while ($row = $result->fetch_assoc()) {
                                    //     echo "<option value='{$row['penduduk_id']}'>{$row['kk']} - {$row['nama_lengkap']}</option>";
                                    // }
                                    ?>
                                </select>
                            </div> -->
                            <div class="mb-3">
                                <label for="search_kk" class="form-label">Nomor KK</label>
                                <input type="text" class="form-control" id="search_kk" placeholder="Ketik Nomor KK atau Nama...">
                                <input type="hidden" id="penduduk_id" name="penduduk_id"> <!-- Penduduk ID disimpan di sini -->
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
        <!-- Modal Edit Bantuan -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Bantuan Sosial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="Back-End/update_bantuan.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="edit_bantuan_id" name="bantuan_id">
                            <div class="mb-3">
                                <label for="edit_kk" class="form-label">Nomor KK</label>
                                <input type="text" class="form-control" id="edit_kk" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit_nama_lengkap" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_daerah" class="form-label">Nama Daerah</label>
                                <input type="text" class="form-control" id="edit_nama_daerah" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                                <input type="text" class="form-control" id="edit_jumlah_keluarga" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_bantuan" class="form-label">Nama Bantuan</label>
                                <input type="text" class="form-control" id="edit_nama_bantuan" name="nama_bantuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                <select class="form-control" id="edit_jenis_bantuan" name="jenis_bantuan" required>
                                    <option value="Uang Tunai">Uang Tunai</option>
                                    <option value="Barang">Barang</option>
                                    <option value="Jasa">Jasa</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
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

        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                // Ambil data dari atribut tombol
                const bantuanId = $(this).data('id');
                const kk = $(this).data('kk');
                const nama = $(this).data('nama');
                const daerah = $(this).data('daerah');
                const jumlah = $(this).data('jumlah');
                const bantuan = $(this).data('bantuan');
                const jenis = $(this).data('jenis');

                // Isi data ke dalam form modal
                $('#editModal #edit_bantuan_id').val(bantuanId);
                $('#editModal #edit_kk').val(kk);
                $('#editModal #edit_nama_lengkap').val(nama);
                $('#editModal #edit_nama_daerah').val(daerah);
                $('#editModal #edit_jumlah_keluarga').val(jumlah);
                $('#editModal #edit_nama_bantuan').val(bantuan);
                $('#editModal #edit_jenis_bantuan').val(jenis);
            });
        });
    </script>
</body>

</html>