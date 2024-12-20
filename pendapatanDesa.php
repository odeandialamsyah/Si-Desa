<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Desa Kampung Ugar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="potensi.css">
    <style>
        body {
            background-image: url('img/bglp.jpg');
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

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin: 5% auto;
            max-width: 90%;
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            object-fit: cover;
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
            background-color: rgba(255, 255, 255, 0.9);
        }

        .card-header {
            background-color: rgba(26, 99, 85, 0.9);
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
            background-color: rgba(255, 255, 255, 0.7);
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
            text-align: center;
        }

        .job-listings {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .job-card {
            flex: 1 1 calc(33.333% - 20px); /* Mengatur lebar card menjadi 3 dalam satu baris */
            margin: 10px;
        }

        /* Fleksibilitas pada perangkat yang lebih kecil */
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
                flex: 1 1 calc(50% - 20px); /* Mengatur lebar card menjadi 2 dalam satu baris */
            }
        }

        @media (max-width: 576px) {
            .job-card {
                flex: 1 1 100%; /* Mengatur lebar card menjadi 1 dalam satu baris di layar kecil */
            }
        }
    </style>
</head>

<body>

    <div class="card mt-3 container">
        <div class="card-header">
            <i class="fas fa-chart-line icon"></i>
            <div class="section-title">PENDAPATAN DESA UGAR DI SEKTOR HASIL LAUT</div>
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
                                        <img src="mancing2.jpg" alt="Job 1" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 2 -->
                                    <div class="job-card card">
                                        <img src="Nelayan2.jpg" alt="Job 2" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Modal Bagi Nelayan Perlu Disiapkan</p>
                                            <p class="card-text"><small class="text-muted">17 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 3 -->
                                    <div class="job-card card">
                                        <img src="Nelayan7.jpg" alt="Job 3" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Terdampak Pandemi Nelayan Minta Pemerintah Beli Tangkapan Mereka</p>
                                            <p class="card-text"><small class="text-muted">07 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 4 -->
                                    <div class="job-card card">
                                        <img src="Nelayan4.jpg" alt="Job 4" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pengadaan Sarana Perikanan</p>
                                            <p class="card-text"><small class="text-muted">17 Mei 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 5 -->
                                    <div class="job-card card">
                                        <img src="Nelayan3.jpg" alt="Job 5" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Kegiatan Sehari-hari Masyarakat Ugar</p>
                                            <p class="card-text"><small class="text-muted">17 September 2023</small></p>
                                        </div>
                                    </div>
                                    <!-- Card 6 -->
                                    <div class="job-card card">
                                        <img src="mancing.jpg" alt="Job 6" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Hasil Laut yang Melimpah di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 September 2023</small></p>
                                        </div>
                                    </div>

                                    <div class="job-card card">
                                        <img src="RL.jpg" alt="Job 1" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Panen rumput laut petani Ugar dibeli Rp 18.500 per kilogram</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>

                                    <div class="job-card card">
                                        <img src="HasilL.jpg" alt="Job 1" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>

                                    <div class="job-card card">
                                        <img src="HL3.jpg" alt="Job 1" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text">Pelelangan Ikan di Ugar</p>
                                            <p class="card-text"><small class="text-muted">18 Agustus 2023</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <a href="landingPage.html" class="btn btn-primary mt-4">Kembali</a>
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