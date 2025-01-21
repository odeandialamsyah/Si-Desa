<?php
// Koneksi database
include 'Koneksi/koneksi.php'; // Pastikan file koneksi benar

// Ambil parameter pencarian dari query string
$q = isset($_GET['q']) ? $_GET['q'] : '';

if ($q !== '') {
    // Query untuk mencari data penduduk berdasarkan KK atau Nama Lengkap
    $query = "
        SELECT p.penduduk_id, p.kk, p.nama_lengkap, d.nama_daerah, p.jumlah_keluarga
        FROM penduduk p
        LEFT JOIN daerah d ON p.daerah_id = d.daerah_id
        WHERE p.kk LIKE ? OR p.nama_lengkap LIKE ?
        LIMIT 10"; // Batas hasil pencarian maksimal 10

    if ($stmt = $conn->prepare($query)) {
        $search = "%$q%"; // Format wildcard untuk pencarian
        $stmt->bind_param('ss', $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        $response = [];
        while ($row = $result->fetch_assoc()) {
            $response[] = [
                'id' => $row['penduduk_id'],
                'kk' => $row['kk'],
                'nama_lengkap' => $row['nama_lengkap'],
                'nama_daerah' => $row['nama_daerah'],
                'jumlah_keluarga' => $row['jumlah_keluarga']
            ];
        }
        
        echo json_encode($response);
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Query failed.']);
    }
} else {
    echo json_encode(['error' => 'Search query is empty.']);
}
?>
