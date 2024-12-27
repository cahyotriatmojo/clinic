<?php
	include('assets/inc/config.php'); // Pastikan file konfigurasi database disertakan


$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['status'])) {
    $id = intval($data['id']);
    $status = $data['status']; // 'aktif' atau 'nonaktif'

    if ($status === 'aktif') {
        // Ambil dokter_id dari jadwal yang akan diaktifkan
        $queryGetDokter = "SELECT dokter_id FROM jadwal_periksa WHERE id = ?";
        $stmtGetDokter = $mysqli->prepare($queryGetDokter);
        $stmtGetDokter->bind_param('i', $id);
        $stmtGetDokter->execute();
        $resultGetDokter = $stmtGetDokter->get_result();
        $dokter = $resultGetDokter->fetch_assoc();

        if ($dokter) {
            $dokter_id = $dokter['dokter_id'];

            // Nonaktifkan jadwal lain yang sudah aktif untuk dokter ini
            $queryDeactivate = "UPDATE jadwal_periksa SET status = 'nonaktif' WHERE dokter_id = ? AND status = 'aktif'";
            $stmtDeactivate = $mysqli->prepare($queryDeactivate);
            $stmtDeactivate->bind_param('i', $dokter_id);
            $stmtDeactivate->execute();
        }
    }

    // Aktifkan atau nonaktifkan jadwal yang dipilih
    $queryUpdate = "UPDATE jadwal_periksa SET status = ? WHERE id = ?";
    $stmtUpdate = $mysqli->prepare($queryUpdate);
    $stmtUpdate->bind_param('si', $status, $id);

    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>


