<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Desa Kampung Ugar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-image: url('img/bglp.jpg'); /* Ganti dengan gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .card-body {
            padding: 20px;
        }

        .feature-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            flex-direction: column; /* Menyusun ikon dan teks secara vertikal */
            align-items: center;
            margin: 10px;
            text-align: center;
        }

        .feature-icon {
            font-size: 3rem; /* Ukuran ikon standar yang cukup besar */
            color: #1A6355;  /* Warna ikon */
            margin-bottom: 10px; /* Jarak antara ikon dan teks */
        }

        .feature-text {
            font-size: 1rem; /* Ukuran teks */
            color: #333;
            margin: 0;
        }


        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Transparansi pada kontainer */
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin: 5% auto;
            max-width: 90%; /* Fleksibilitas ukuran sesuai layar */
        }

        .card-body img {
            margin-left: 90px;
            width: 100%; /* Ensures the image fills the column width */
            max-width: 250px; /* Limits the maximum width of the image */
            height: auto; /* Keeps the aspect ratio of the image */
            object-fit: cover; /* Ensures the image covers the area */
        }

        .card-body iframe {
            width: 100%;
            height: 700px; /* Anda dapat menyesuaikan tinggi sesuai kebutuhan */
            border-radius: 5px;
        }

        .card-body p {
            font-size: 1rem; /* Adjusts the font size for readability */
            line-height: 1.6; /* Improves readability with better line spacing */
            margin-top: auto; /* Aligns the text vertically */
            margin-bottom: auto;
        }


        h1 {
            color: #1A6355;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            color: #317A6C;
            font-size: 1.1rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn btn-primary btn-lg {
            align-items: center;
        }

        .btn-primary {
            background-color: #1A6355;
            border-color: #1A6355;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 30px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #145a46;
            border-color: #145a46;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Transparansi pada card */
        }

        .card-header {
            background-color: rgba(26, 99, 85, 0.9); /* Transparansi pada header card */
            color: #fff;
            padding: 20px;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-body {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7); /* Transparansi pada body card */
        }

        .icon {
            font-size: 60px;
            color: #FFFFFF;
            margin-right: 10px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }

        .footer {
            margin-top: 40px;
            color: #333;
            font-size: 0.9rem;
        }

        nav ul li a {
    color:BLUE;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s;
  padding: 10px 20px;
  border-radius: 4px;
}


        /* Fleksibilitas pada perangkat yang lebih kecil */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
                text-align: center;
            }

            .btn-primary {
                font-size: 1rem;
            }

            .card-header {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#section1">FITUR UTAMA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">PROFIL DESA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">SAMBUTAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section4">VISI MISI</a>
                </li><br>
               
                <li class="nav-item">
                    <a class="nav-link" href="#section5">PENDAPATAN DAN POTENSI DESA</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>SELAMAT DATANG DI SISTEM INFORMASI DESA UGAR</h1>
        <p>Aplikasi ini dirancang untuk mempermudah akses informasi dan pelayanan di desa Anda. 
            Dengan teknologi yang mudah digunakan, kami hadir untuk mendukung transparansi, efisiensi, 
            dan keterbukaan informasi bagi seluruh masyarakat desa. Melalui aplikasi ini, warga desa 
            dapat dengan cepat mendapatkan informasi terbaru, mengakses layanan administratif, dan 
            berinteraksi dengan perangkat desa. Mari bersama-sama membangun desa yang lebih maju dan 
            sejahtera melalui pemanfaatan teknologi.
        </p>
        <div class="d-flex justify-content-center">
            <button onclick="window.location.href='login.html'" class="btn btn-primary btn-lg">Masuk ke Sistem</button>
        </div>


        
        <div id="section1"></div>
        <div  class="card mt-3">
            <div  class="card-header">
                <i class="fas fa-cogs icon"></i>

                <div  class="section-title">Fitur Utama</div>
            </div>
            <div class="card-body">
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-users feature-icon"></i>
                        <div class="feature-text">Pengelolaan Data Penduduk</div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-hand-holding-heart feature-icon"></i>
                        <div class="feature-text">Monitoring Bantuan Sosial</div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <div class="feature-text">Laporan Statistik Desa</div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Video Desa -->
        <div id="section2"></div>
        <div  class="card mt-3">
            <div class="card-header">
                <i class="fas fa-video icon"></i>
                <div class="section-title">Video Profil Kampung Ugar</div>
            </div>
            <div class="card-body">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/4YtB5XkVsm0?si=1I1HM6f2NZdJtI_7"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <!-- Sambutan Kepala Desa -->
         <div id="section3"></div>
        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-user-tie icon"></i>
                <div class="section-title">Sambutan Kepala Desa</div>
            </div>
            <div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <img src="img/ftKplDesa.jpeg" alt="Kepala Desa" class="img-fluid rounded mb-3">
        </div>
        <div class="col-md-8">
            <h5 class="text-left">Muhamad Tahir, Kepala Desa Kampung Ugar</h5>
            <p class="text-left">Selamat datang di Kampung Ugar, tempat di mana tradisi bertemu dengan inovasi. Sebagai Kepala Desa, saya berkomitmen untuk terus meningkatkan pelayanan kepada seluruh warga dan memajukan Kampung Ugar dengan semangat kebersamaan. Kami akan menjaga dan melestarikan kearifan lokal yang telah diwariskan oleh leluhur kami, sekaligus memanfaatkan potensi alam yang melimpah untuk kesejahteraan bersama.</p>

            <p class="text-left">Kampung Ugar memiliki kekayaan budaya dan sumber daya alam yang luar biasa, mulai dari wisata bahari hingga keindahan goa-goa yang menyimpan sejarah panjang peradaban desa ini. Dengan dukungan dari seluruh masyarakat, kita akan menciptakan lingkungan yang harmonis dan sejahtera. Mari bersama-sama kita wujudkan Kampung Ugar yang lebih maju, aman, dan menjadi teladan bagi desa-desa lainnya di Indonesia.</p>

            <p class="text-left">Saya mengajak seluruh warga untuk terus bersatu dalam upaya membangun desa kita tercinta ini. Dengan kerja keras dan doa, saya yakin bahwa Kampung Ugar akan terus berkembang dan memberikan kehidupan yang lebih baik bagi seluruh warganya. Terima kasih atas kepercayaan dan dukungan yang telah diberikan. Semoga kita semua selalu diberkahi dan dilindungi oleh Tuhan Yang Maha Esa.</p>
        </div>
    </div>
</div>

        </div>



        <!-- Visi dan Misi Kampung Ugar -->
         <div id="section4"></div>
        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-bullseye icon"></i>
                <div class="section-title">Visi dan Misi Kampung Ugar</div>
            </div>
            <div class="card-body">
                <h4>Visi</h4>
                <p>Menjadikan Kampung Ugar sebagai desa wisata unggulan yang berkelanjutan dengan mengedepankan
                    pelestarian budaya dan lingkungan.</p>
                <h4>Misi</h4>
                <ul>
                    <li>Mengembangkan potensi wisata bahari dan sejarah secara berkelanjutan.</li>
                    <li>Meningkatkan kesejahteraan masyarakat melalui pengelolaan sumber daya alam yang bijaksana.</li>
                    <li>Mendorong partisipasi aktif masyarakat dalam pelestarian budaya dan lingkungan.</li>
                    <li>Meningkatkan kualitas infrastruktur untuk mendukung pariwisata dan ekonomi lokal.</li>
                </ul>
            </div>
        </div>
            
        <!-- Pemetaan Pendapatan Desa dan Potensi Desa -->
         <div id="section5"></div>
        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-chart-line icon"></i>
                <div class="section-title">Pemetaan Pendapatan dan Potensi Desa Ugar</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="feature-item">
                            <i class="fas fa-fish feature-icon"></i>
                            <div class="feature-text">
                                <b><a style="text-decoration:none; color:black" href="pendapatanDesa.html"> Pendapatan Desa</a></b> <br>
                                <strong></strong> Mayoritas pendapatan desa berasal dari sektor perikanan dan
                                pariwisata. Selain itu, pertanian dan perdagangan lokal juga menjadi sumber pendapatan penting
                                lainnya.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-item">
                            <i class="fas fa-map-marker-alt feature-icon"></i>
                            <div class="feature-text">
                                <b><a style="text-decoration:none; color:black" href="potensiDesa.html">Potensi Desa</a></b> <br>
                                <strong></strong> Kampung Ugar memiliki potensi besar dalam pengembangan wisata bahari,
                                wisata sejarah, dan kuliner khas Papua. Selain itu, desa ini juga memiliki potensi dalam bidang
                                konservasi satwa dan pelestarian lingkungan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Footer -->
        <div class="footer mt-5">
            <p>&copy; 2024 Sistem Informasi Desa Kampung Ugar. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('nav a').forEach(link => {
          link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = e.target.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            targetSection.scrollIntoView({ behavior: 'smooth' });
          });
        });
      </script>
</body>

</html>
