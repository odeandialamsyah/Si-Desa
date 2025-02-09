<?php
// Include file koneksi
include 'Back-End/Koneksi/koneksi.php';

// Ambil data dari tabel laporan
$query = "SELECT laporan.laporan_id, laporan.nama_pelapor, daerah.nama_daerah, daerah.jenis_daerah, laporan.laporan, laporan.foto_aduan, laporan.foto_hasil,laporan.status, laporan.created_at 
FROM
laporan
JOIN daerah ON laporan.daerah_id = daerah.daerah_id
ORDER BY laporan.created_at DESC;";

$result = $conn->query($query);
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
    <title>Laporan Pengaduan</title>
    <style>
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: auto;
            max-width: 90%;
            margin-bottom: 20px;
            /* Tambahkan margin bawah untuk memberikan jarak antar table-container */
        }

        .table-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .table-container table {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <main>
            <div class="table-container">
                <h2 class="text-center my-4"><b>Laporan Bantuan sosial</b></h2>
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
                            <th scope="col">Status</th>
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
                                <td>{$row['status']}</td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>