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

        /* Flexbox adjustments for horizontal layout */
        .job-listings {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .job-card {
            flex: 1 1 calc(33.333% - 20px); /* Set card width for three cards per row */
            margin: 10px;
            text-align: center;
        }

        /* Responsiveness for smaller devices */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            .btn-primary {
                font-size: 1rem;
            }

            .card-header {
                font-size: 1rem;
            }

            .job-card {
                flex: 1 1 calc(50% - 20px); /* Two cards per row */
            }
        }

        @media (max-width: 576px) {
            .job-card {
                flex: 1 1 100%; /* One card per row on small screens */
            }
        }
    </style>
</head>

<body>

    <div class="card mt-3 container">
        <div class="card-header">
            <i class="fas fa-chart-line icon"></i>
            <div class="section-title">POTENSI DESA UGAR DIBIDANG PARIWISATA</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="feature-item">
                        <div class="feature-text mb-4">
                            <b><a style="text-decoration:none; color:black" href="pendapatanDesa.html"></a></b><br>
                        </div>

                        <section class="content-box" id="lowongan">
                            <div class="content-text">
                                <div class="job-listings">
                                    <!-- Card 1 -->
                                    <div class="job-card card">
                                        <img src="PW1.jpg" alt="Job 1" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 2 -->
                                    <div class="job-card card">
                                        <img src="PW2.jpg" alt="Job 2" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Modal Bagi Nelayan Perlu Disiapkan</p>
                                            <p class="card-text"><small class="text-muted">17 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 3 -->
                                    <div class="job-card card">
                                        <img src="PW3.jpg" alt="Job 3" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Terdampak Pandemi Nelayan Minta Pemerintah Beli Tangkapan Mereka</p>
                                            <p class="card-text"><small class="text-muted">07 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 4 -->
                                    <div class="job-card card">
                                        <img src="PW4.jpg" alt="Job 4" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pengadaan Sarana Perikanan</p>
                                            <p class="card-text"><small class="text-muted">17 Mei 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 5 -->
                                    <div class="job-card card">
                                        <img src="PW5.jpg" alt="Job 5" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Kegiatan Sehari-hari Masyarakat Ugar</p>
                                            <p class="card-text"><small class="text-muted">17 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 6 -->
                                    <div class="job-card card">
                                        <img src="PW6.jpg" alt="Job 6" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Hasil Laut yang Melimpah di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Additional Cards -->
                                    <div class="job-card card">
                                        <img src="PW1.jpg" alt="Job 7" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Panen Rumput Laut Petani Ugar Dibeli Rp 18.500 per Kilogram</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                    <div class="job-card card">
                                        <img src="PW2.jpg" alt="Job 8" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                    <div class="job-card card">
                                        <img src="PW3.jpg" alt="Job 9" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <a href="index.php" class="btn btn-primary mt-4">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer mt-5">
        <p>&copy; 2024 Sistem Informasi Desa Kampung Ugar. All rights reserved.</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>