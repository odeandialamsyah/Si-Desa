<?php
session_start();
include 'Koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bantuan_kelompok_id = $_POST['bantuan_kelompok_id'];
    $nama_bantuan = $_POST['nama_bantuan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
    $status = $_POST['status'];

    // Cek apakah ada file yang diunggah
    if (!empty($_FILES['foto_bukti_kelompok']['name'])) {
        $foto_bukti = $_FILES['foto_bukti_kelompok'];
        $upload_dir = '../uploads/';
        $filename = time() . '_' . basename($foto_bukti['name']);
        $destination = $upload_dir . $filename;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($foto_bukti['type'], $allowed_types)) {
            if (move_uploaded_file($foto_bukti['tmp_name'], $destination)) {
                // Update database dengan foto baru
                $queryUpdate = "
                    UPDATE bantuan_kelompok
                    SET 
                        nama_bantuan = ?,
                        jenis_bantuan = ?,
                        status = ?,
                        foto_bukti_kelompok = ?,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE bantuan_kelompok_id = ?
                ";
                $stmt = $conn->prepare($queryUpdate);
                $stmt->bind_param("ssssi", $nama_bantuan, $jenis_bantuan, $status, $filename, $bantuan_kelompok_id);
            } else {
                echo "<script>alert('Gagal mengunggah file.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Tipe file tidak valid. Hanya JPG, JPEG, dan PNG diperbolehkan.'); window.history.back();</script>";
            exit();
        }
    } else {
        // Jika tidak ada file yang diunggah, hanya update data lainnya
        $queryUpdate = "
            UPDATE bantuan_kelompok
            SET 
                nama_bantuan = ?,
                jenis_bantuan = ?,
                status = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE bantuan_kelompok_id = ?
        ";
        $stmt = $conn->prepare($queryUpdate);
        $stmt->bind_param("sssi", $nama_bantuan, $jenis_bantuan, $status, $bantuan_kelompok_id);
    }

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../BantuanSosialKelompok.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
