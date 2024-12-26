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
                    <td colspan="7" style="text-align: center;">
                        <h2><b>YANG TELAH MENERIMA BANTUAN SOSIAL</b></h2>
                    </td>
                </tr>
                <tr>
                    <table class="table table-striped">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Tambah penerima bantuan
                        </button>
                        <thead style="background-color: #D9D9D9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor KK</th>
                                <th scope="col">Nama Kepala Keluarga</th>
                                <th scope="col">RT / RW</th>
                                <th scope="col">Jumlah Keluarga</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="redirectToDetail('PenerimanBantuan.html')" style="cursor: pointer;">
                                <td>1</td>
                                <td>979868758769</td>
                                <td>Bambang</td>
                                <td>07/08</td>
                                <td>4 orang</td>
                                <td>
                                    <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                                    <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                                    <i class="fa-solid fa-eye mr-2" style="color: #2ad53e;" data-bs-toggle="modal" data-bs-target="#modal1"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
            </table>
        </main>

        <!-- Modal untuk detail bantuan sosial -->
        <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Bukti penerima bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="PB.jpg" alt="" style="width: 100%; height: auto;">
                        <p id="modalDescription">Keterangan bantuan...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk menambahkan penerima bantuan -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5"
id="staticBackdropLabel">Tambah Penerima Bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nomorKK" class="form-label">Nomor KK</label>
                                <input type="text" class="form-control" id="nomorKK" placeholder="Masukkan Nomor KK">
                            </div>
                            <div class="mb-3">
                                <label for="namaKK" class="form-label">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" id="namaKK" placeholder="Masukkan Nama Kepala Keluarga">
                            </div>
                            <div class="mb-3">
                                <label for="rtRw" class="form-label">RT / RW</label>
                                <input type="text" class="form-control" id="rtRw" placeholder="Masukkan RT/RW">
                            </div>
                            <div class="mb-3">
                                <label for="jumlahKeluarga" class="form-label">Jumlah Keluarga</label>
                                <input type="text" class="form-control" id="jumlahKeluarga" placeholder="Masukkan Jumlah Keluarga">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menggunakan Bootstrap dan jQuery dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function redirectToDetail(url) {
            window.location.href = url;
        }

        // Script untuk menangani modal image dan description
        $('.fa-eye').click(function() {
            var imageSrc = $(this).data('image');
            var description = $(this).data('description');
            $('#modalImage').attr('src', imageSrc);
            $('#modalDescription').text(description);
        });
        
    </script>
</body>
</html>