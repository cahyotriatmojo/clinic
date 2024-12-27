<?php
require_once 'assets/inc/config.php'; // Koneksi database

if (isset($_GET['dokter_id'])) {
    $dokter_id = $_GET['dokter_id'];
    $query = "SELECT id, hari, jam_mulai, jam_selesai FROM jadwal_periksa WHERE dokter_id = ? AND status = 'aktif'";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $dokter_id);
    $stmt->execute();
    $res = $stmt->get_result();

    $jadwals = [];
    while ($row = $res->fetch_assoc()) {
        $jadwals[] = [
            'id' => $row['id'],
            'hari' => $row['hari'],
            'jam_mulai' => $row['jam_mulai'],
            'jam_selesai' => $row['jam_selesai']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($jadwals);
}
?>
