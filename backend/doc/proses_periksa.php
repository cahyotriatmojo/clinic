<?php
// Koneksi ke database
require 'assets/inc/config.php';

// Ambil data dari form dengan validasi
$daftar_poli_id = isset($_POST['daftar_poli_id']) ? (int) $_POST['daftar_poli_id'] : 0;
$tgl_periksa = isset($_POST['tgl_periksa']) ? trim($_POST['tgl_periksa']) : date('Y-m-d');
$total_biaya = isset($_POST['total_biaya']) ? (float) $_POST['total_biaya'] : 0.0;
$catatan = isset($_POST['catatan']) ? trim($_POST['catatan']) : "";

// Query untuk menyimpan data pemeriksaan
$query = "INSERT INTO periksa (daftar_poli_id, tgl_periksa, total_biaya, catatan) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param('isds', $daftar_poli_id, $tgl_periksa, $total_biaya, $catatan);
    $stmt->execute();

    // Ambil ID periksa yang baru saja disimpan
    $periksa_id = $stmt->insert_id;

    // Insert detail periksa (obat-obat yang diberikan)
    if (isset($_POST['obat']) && is_array($_POST['obat'])) {
        foreach ($_POST['obat'] as $obat_id) {
            $query_detail = "INSERT INTO detail_periksa (periksa_id, obat_id) VALUES (?, ?)";
            $stmt_detail = $mysqli->prepare($query_detail);
            if ($stmt_detail) {
                $stmt_detail->bind_param('ii', $periksa_id, $obat_id);
                $stmt_detail->execute();
            }
        }
    } else {
        echo "Tidak ada obat yang dipilih, tetapi pemeriksaan tetap disimpan.";
    }

    echo "Pemeriksaan berhasil disimpan dengan total biaya: Rp " . number_format($total_biaya, 2);
} else {
    echo "Terjadi kesalahan saat menyimpan data pemeriksaan.";
}


$mysqli->close();
?>
