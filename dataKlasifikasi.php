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
                    <a href="dataKlasifikasi.html" class="active" style="text-decoration: none;">
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
            <table>
                <tr class="large-font">
            <td colspan="7" style="text-align: center;">
                <h2><b>DATA KLASIFIKASI</b></h2>
            </td>
        </tr>
                
 <tr style="background-color: #D9D9D9;">
                    <th scope="col">No</th>
                    <th scope="col">Klasifikasi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Range Umur</th>
                  
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>1</td>
                    <td>Anak-anak</td>
                    <td>50 Orang</td>
                    <td>0-12 Tahun</td>
                   
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>2</td>
                    <td>Remaja</td>
                    <td>30 Orang</td>
                    <td>13-17 Tahun</td>
                    
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>3</td>
                    <td>Dewasa</td>
                    <td>48 Orang</td>
                    <td>18-59 Tahun</td>
                   
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
                <tr onclick="redirectToDetail('detailAnggota1.html')">
                    <td>4</td>
                    <td>Lansia</td>
                    <td>10 Orang</td>
                    <td>60 Tahun ke atas</td>
                    
                    <td>
                        <i class="fa-solid fa-pen-to-square mr-2" style="color: #e17833;"></i>
                        <i class="fa-solid fa-trash mr-2" style="color: #ff0000;"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

        <script type="text/javascript" src="index.js"></script>
        <script type="text/javascript" src="dataAnggota.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </div>
</body>
</html>