<?php
session_start();
include 'Koneksi/koneksi.php'; // File koneksi database

$user_id = $_GET['user_id'] ?? null; // Dapatkan user_id dari parameter
$query = $_GET['q'] ?? '';

// Pastikan query dan user_id tidak kosong
if (!empty($query) && !empty($user_id)) {
    $stmt = $conn->prepare("
        SELECT * 
        FROM penduduk 
        WHERE (kk LIKE ? OR nama_lengkap LIKE ?)
        AND user_id = ?
    ");
    $search = "%{$query}%";
    $stmt->bind_param('ssi', $search, $search, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode([]);
}
