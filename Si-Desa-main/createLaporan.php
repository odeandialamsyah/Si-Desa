<?php
// Include file koneksi
include 'Back-End/Koneksi/koneksi.php';

// Tangani pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pelapor = $conn->real_escape_string($_POST['nama_pelapor']);
    $daerah_id = $conn->real_escape_string($_POST['daerah_id']);
    $laporan = $conn->real_escape_string($_POST['laporan']);

    // Simpan data ke tabel
    $sql = "INSERT INTO laporan (nama_pelapor, daerah_id, laporan) VALUES ('$nama_pelapor', '$daerah_id', '$laporan')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Laporan berhasil dikirim!";
    } else {
        $errorMessage = "Error: " . $conn->error;
    }
}

// Ambil data daerah dari tabel daerah
$daerahQuery = "SELECT daerah_id, nama_daerah, jenis_daerah FROM daerah";
$daerahResult = $conn->query($daerahQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengaduan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin: 5% auto;
            max-width: 90%;
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

        .navbar ul li a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#section1">FITUR UTAMA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#section2">PROFIL DESA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#section3">SAMBUTAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#section4">VISI MISI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#section5">PENDAPATAN DAN POTENSI DESA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="createLaporan.php">PENGADUAN</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Formulir Pengaduan -->
    <div class="container mt-5 pt-5">
        <h1>Formulir Pengaduan</h1>
        <p>Isi formulir berikut untuk menyampaikan pengaduan Anda.</p>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success"><?= $successMessage ?></div>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama_pelapor">Nama Pelapor</label>
                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" required>
            </div>
            <div class="form-group">
                <label for="daerah_id">Daerah</label>
                <select class="form-control" id="daerah_id" name="daerah_id" required>
                    <option value="" disabled selected>Pilih Daerah</option>
                    <?php while ($row = $daerahResult->fetch_assoc()): ?>
                        <option value="<?= $row['daerah_id'] ?>">
                            <?= $row['nama_daerah'] ?> (<?= $row['jenis_daerah'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="laporan">Laporan</label>
                <textarea class="form-control" id="laporan" name="laporan" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Laporan</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
