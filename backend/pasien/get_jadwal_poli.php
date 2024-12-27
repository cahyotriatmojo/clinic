<?php
require 'config.php'; // Koneksi ke database

if (isset($_GET['poli_id'])) {
    $poli_id = intval($_GET['poli_id']); // Sanitasi input
    $query = "
        SELECT jd.id, d.nama_dokter, jd.hari, jd.jam_mulai, jd.jam_selesai
        FROM jadwal_dokter jd
        JOIN dokter d ON jd.dokter_id = d.id
        WHERE jd.poli_id = ?
    ";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $poli_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $jadwal = [];
    while ($row = $result->fetch_assoc()) {
        $jadwal[] = [
            'id' => $row['id'],
            'nama_dokter' => $row['nama_dokter'],
            'hari' => $row['hari'],
            'jam_mulai' => $row['jam_mulai'],
            'jam_selesai' => $row['jam_selesai']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($jadwal);
    exit;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Poli ID tidak ditemukan.']);
}
