<?php
require_once 'assets/inc/config.php'; // Koneksi database

if (isset($_GET['poli_id'])) {
    $poli_id = $_GET['poli_id'];
    $query = "SELECT doc_id, doc_fname FROM his_docs WHERE poli_id = ? AND deleted_at IS NULL";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $poli_id);
    $stmt->execute();
    $res = $stmt->get_result();

    $dokters = [];
    while ($row = $res->fetch_assoc()) {
        $dokters[] = [
            'doc_id' => $row['doc_id'],
            'doc_fname' => $row['doc_fname']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($dokters);
}
?>
