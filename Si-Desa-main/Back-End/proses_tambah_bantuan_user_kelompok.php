<?php
// Koneksi database
include 'Koneksi/koneksi.php'; // Pastikan koneksi sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    // $user_id = $_POST['user_id'];
    $userIDs = $_POST['userIDUser']; // Array of user IDs
    $nama_bantuan = $_POST['nama_bantuan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];

    // Query untuk memasukkan data ke dalam tabel bantuan
    $query = "INSERT INTO bantuan_kelompok (nama_bantuan,jenis_bantuan) VALUES (?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ss', $nama_bantuan, $jenis_bantuan);
        $stmt->execute();

        $batch_id = $stmt->insert_id;

        if ($stmt->affected_rows > 0) {
            $query2 = "INSERT INTO batch_users (batch_id, user_id) VALUES (?, ?)";
            if ($stmt2 = $conn->prepare($query2)) {
                if (isset($_POST['userIDUser']) && is_array($_POST['userIDUser'])) {
                    foreach ($userIDs as $userID) {
                        // Proses setiap user ID di sini
                        $stmt2->bind_param('ii', $batch_id, $userID);
                        $stmt2->execute();
                    }
                    if ($stmt2->affected_rows > 0) {
                        echo "<script>alert('Data Bantuan berhasil ditambahkan!'); window.location.href='../bantuan_kelompok.php';</script>";
                    } else {
                        echo "<script>alert('Gagal menambahkan data ke tabel batch_users. Silakan coba lagi.'); window.history.back();</script>";
                    }
                }
            } else {
                echo "Method tidak valid!";
            }
            // if ($stmt2 = $conn->prepare($query2)) {
            //     foreach ($user_ids as $user_id) {
            //         $stmt2->bind_param('ii', $batch_id, $user_id);
            //         $stmt2->execute();
            //     }

            //     if ($stmt2->affected_rows > 0) {
            //         echo "<script>alert('Data Bantuan berhasil ditambahkan!'); window.location.href='../bantuan_kelompok.php';</script>";
            //     } else {
            //         echo "<script>alert('Gagal menambahkan data ke tabel batch_users. Silakan coba lagi.'); window.history.back();</script>";
            //     }

            //     $stmt2->close();
            // } else {
            //     echo "Method tidak valid!";
            // }
        } else {
            echo "<script>alert('Gagal menambahkan data. Silakan coba lagi.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    echo "Method tidak valid!";
}
