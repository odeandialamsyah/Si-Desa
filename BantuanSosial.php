<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Menggunakan Bootstrap dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dataAnggota.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    
    <!-- Menggunakan Font Awesome dan Line Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            width: 100px;
        }

        .button:hover {
            background-color: #3e8e41;
        }
    </style>

    <title>Sistem Informasi Desa</title>
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
                    <a href="index.html" style="text-decoration: none;">
                        <span class="fa fa-compass"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="dataKlasifikasi.html" style="text-decoration: none;">
                        <span class="fa fa-users"></span>
                        <small>Data Klasifikasi</small>
                    </a>
                </li>
               
                <li>
                    <a href="dataPenduduk.html" style="text-decoration: none;">
                        <span class="fa fa-user"></span>
                        <small>Data Penduduk</small>
                    </a>
                </li>
                <li>
                    <a href="BantuanSosial.html" class="active" style="text-decoration: none;">
                        <span class="fa fa-info-circle"></span>
                        <small>Bantuan Sosial</small>
                    </a>
                </li>
                <li>
                    <a href="laporan.html" style="text-decoration: none;">
                        <span class="fa fa-list-alt"></span>
                        <small>Laporan </small>
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
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
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