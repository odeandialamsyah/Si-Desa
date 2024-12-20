<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dataAnggota.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sistem Informasi Desa</title>
</head>
<body>


    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container-fluid {
            padding: 20px;
        }
        .detail-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .detail-card h3 {
            margin-top: 0;
            font-size: 18px; /* Ukuran font untuk judul utama */
        }
        .detail-card h3 a {
            color: black;
            text-decoration: none;
        }
        .detail-card h3 i {
            color: #000000;
            font-size: 14px; /* Ukuran font untuk ikon */
        }
        .section-title {
            background-color: #D9D9D9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px; /* Ukuran font untuk judul bagian */
        }
        .section-content {
            margin-bottom: 20px;
            font-size: 14px; /* Ukuran font untuk konten bagian */
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            font-size: 14px; /* Ukuran font untuk item daftar */
        }
        .list-group-item:last-child {
            border-bottom: none;
        }


        .penduduk-detail {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 0 auto;
        }
        .penduduk-detail img {
            width: 150px;
            height: auto;
            border-radius: 8px;
            display: block;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
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
                    <a href="BantuanSosial.html" style="text-decoration: none;">
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
 <div class="container-fluid">
            <div class="detail-card">
                <h3>
                    <a href="dataKartuKeluarga.html" style="color: black; text-decoration: none;">
                            <i class="fas fa-caret-left mr-2" style="color: #000000; font-size: 15px;"></i></a>
                <b>Detail Kartu Keluarga</b></h3>


                
                <div class="section-title">Informasi Utama</div>
                <div class="section-content">
                    <p><strong>Nomor KK:</strong> 979868758769</p>
                    <p><strong>Nama Kepala Keluarga:</strong> Bambang</p>
                    <p><strong>RT / RW:</strong> 07/08</p>
                    <p><strong>Jumlah Keluarga:</strong> 4 orang</p>
                    <p><strong>Alamat:</strong> Jl. Contoh Alamat No. 123, Desa Contoh, Kabupaten Contoh</p>
                    <p><strong>Tanggal Pembuatan:</strong> 01 Januari 2022</p>
                </div>

                <div class="section-title">Detail Anggota Keluarga</div>

                <div class="section-title">Data Istri</div>
                <div class="section-content">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nama Istri:</strong>Siti Aisyah<br>
                            <strong>Tempat/Tanggal Lahir:</strong> Bandung, 01 Februari 1985<br>
                            <strong>Jenis Kelamin:</strong> Perempuan <br>
                            <strong>Pekerjaan:</strong> Ibu Rumah Tangga
                        </li>
                    </ul>
                </div>

                <div class="section-title">Data Anak</div>
                <div class="section-content">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nama:</strong> Ahmad<br>
                            <strong>Status:</strong> Anak angkat<br>
                            <strong>Tempat/Tanggal Lahir:</strong> Jakarta, 01 Januari 2015<br>
                            <strong>Jenis Kelamin:</strong> Laki-laki
                        </li>
                        <li class="list-group-item">
                            <strong>Nama:</strong> Siti<br>
                            <strong>Status:</strong> Anak kandung<br>
                            <strong>Tempat/Tanggal Lahir:</strong> Jakarta, 01 Januari 2017<br>
                            <strong>Jenis Kelamin:</strong> Perempuan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>