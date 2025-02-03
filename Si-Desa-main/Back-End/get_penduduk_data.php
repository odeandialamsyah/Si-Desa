<?php
// Koneksi database
include 'Koneksi/koneksi.php'; // Pastikan koneksi sudah benar

// Ambil penduduk_id dari query string
$penduduk_id = isset($_GET['penduduk_id']) ? $_GET['penduduk_id'] : '';

// Cek jika penduduk_id valid
if ($penduduk_id) {
    // Query untuk mengambil data penduduk dan daerah
    $query = "
        SELECT p.nama_lengkap, p.jumlah_keluarga, d.nama_daerah
        FROM penduduk p
        LEFT JOIN daerah d ON p.daerah_id = d.daerah_id
        WHERE p.penduduk_id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $penduduk_id);
        $stmt->execute();
        $stmt->bind_result($nama_lengkap, $jumlah_keluarga, $nama_daerah);
        
        // Jika data ditemukan
        if ($stmt->fetch()) {
            // Return data dalam format JSON
            echo json_encode([
                'nama_lengkap' => $nama_lengkap,
                'jumlah_keluarga' => $jumlah_keluarga,
                'nama_daerah' => $nama_daerah
            ]);
        } else {
            // Jika tidak ditemukan, kirimkan data kosong
            echo json_encode([
                'nama_lengkap' => '',
                'jumlah_keluarga' => '',
                'nama_daerah' => ''
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            'error' => 'Query failed.'
        ]);
    }
} else {
    echo json_encode([
        'error' => 'Invalid penduduk_id.'
    ]);
}
?>
