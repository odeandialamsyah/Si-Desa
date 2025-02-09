<?php
session_start();
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Cek session login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Include koneksi
include 'Koneksi/koneksi.php';

// Tangkap HTML dari halaman laporan.php
ob_start();
include '../lpdf.php';  // Pastikan file ini bisa diakses langsung
$html = ob_get_clean();

// Inisialisasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML dan Render PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Kirim output ke browser
$dompdf->stream("laporan_bansos.pdf", ["Attachment" => false]);
?>
