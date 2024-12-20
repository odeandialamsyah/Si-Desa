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
    <link rel="stylesheet" type="text/css" href="tataletak.css">
    <title>Sistem Informasi Desa</title>
</head>
<body>
    <style>
        .main {
            font-size: 11px !important;
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
        
        /* Teks "Jenis Bantuan yang Diterima" */
        .jenis-bantuan-title {
            text-align: center;
            font-size: 14px; /* Ukuran lebih kecil dari teks lainnya */
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Daftar jenis bantuan */
        .jenis-bantuan-list {
            list-style-type: disc;
            margin-left: 20px;
            font-size: 12px; /* Perkecil teks */
            text-align: center;
        }

    </style>

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
                    <a href="dataPenduduk.html" class="active" style="text-decoration: none;">
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
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            <table style="font-size: 12px;">
                <tr class="large-font">
                    <b>Detail Penerima</b>
                </tr>
                <tr>
                  <tbody>
                    <tr style="height:25px;">
                        <td rowspan="7" width="250px"><img src="img/ftL1.jpg" width="250px"></td>
                      <td width="350px"><b>NIK</b></td>
                      <td>893749823</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Nama</b></td>
                      <td>Bambang</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Jenis Kelamin</b></td>
                      <td>Laki-Laki</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Tempat, Tanggal Lahir</b></td>
                      <td>Fakfak, 12 Agustus 1999</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Agama</b></td>
                      <td>Islam</td>
                    </tr>
                    <tr style="height:25px;">
                      <td><b>Alamat</b></td>
                      <td>Jl.Pattimura</td>
                    </tr>
                  </tbody>
            </table>

            <table class="table table-striped">
                <thead>

                    <th colspan="6">Detail Anggota Keluarga</th>
                    <th colspan="6"></th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">Data Suami</td>
                        <td colspan="3">Data Istri</td>
                        <td colspan="3">Data Anak</td>
                    </tr>
                    <tr>
                        <td>Nama</td><td>:</td><td>Bambang</td>
                        <td>Nama</td><td>:</td><td>Siti Aisyah</td>
                        <td>Nama</td><td>:</td><td>Ahmad</td>
                    </tr>

                    <tr>
                        <td>TTL</td><td>:</td><td>Jakarta</td>
                        <td>TTL</td><td>:</td><td>Bandung</td>
                        <td>TTL</td><td>:</td><td>Fakfak</td>
                    </tr>

                    <tr>
                        <td>Pekerjaan</td><td>:</td><td>Nelayan</td>
                        <td>Pekerjaan</td><td>:</td><td>Ibu Rumah Tangga</td>
                        <td>Pekerjaan</td><td>:</td><td>Mahasiswi</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-striped">
                <thead>
                    <th colspan="6">Dokumentasi</th><br>
                    <th colspan="6">Jenis Bantuan</th>


                    <!-- Teks "Bukti penerima bantuan" diperkecil -->
                  
                    <tr style="height: 50px;">
                        <!-- Wrapper untuk gambar dan list bantuan menggunakan flex -->
                        <td colspan="3">
                            <div class="bantuan-container">
                                <!-- Gambar penerima bantuan -->
                                <div class="bantuan-image">
                                    <img src="PB.jpg" width="250px" alt="Foto Penerima Bantuan">
                                </div>
            
                                <!-- Daftar jenis bantuan yang diterima -->
                                <div class="jenis-bantuan-list">
                                    <ul>
                                        <li>Sembako</li>
                                        <li>Uang Tunai</li>
                                        <li>Bantuan Pengobatan</li>
                                        <li>Bantuan Pendidikan</li>
                                        <li>Bantuan Tempat Tinggal</li>
                                        <li>Pakaian</li>
                                        <li>Lainnya</li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
               
        </main>
    </div>

    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="penerima_bantuan.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
