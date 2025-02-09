<?php
include 'Koneksi/koneksi.php';

// Ambil data untuk grafik agama
$agamaData = [];
$sql = "SELECT a.nama_agama, COUNT(p.penduduk_id) as jumlah FROM penduduk p JOIN agama a ON p.agama_id = a.agama_id GROUP BY a.nama_agama";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $agamaData[] = $row;
}

// Ambil data untuk grafik daerah
$daerahData = [];
$sql = "SELECT d.nama_daerah, COUNT(p.penduduk_id) as jumlah FROM penduduk p JOIN daerah d ON p.daerah_id = d.daerah_id GROUP BY d.nama_daerah";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $daerahData[] = $row;
}

// Ambil data untuk grafik klasifikasi (contoh: berdasarkan jenis kelamin)
$klasifikasiData = [];
$sql = "SELECT jenis_kelamin, COUNT(penduduk_id) as jumlah FROM penduduk GROUP BY jenis_kelamin";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $klasifikasiData[] = $row;
}

$data = [
    'agama' => $agamaData,
    'daerah' => $daerahData,
    'klasifikasi' => $klasifikasiData
];

echo json_encode($data);

$conn->close();
?>