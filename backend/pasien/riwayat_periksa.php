<?php
session_start();
include 'assets/inc/config.php'; // Sesuaikan path ke file koneksi

// Cek apakah pasien sudah login
if (!isset($_SESSION['id'])) {
    die("Anda belum login. Silakan login terlebih dahulu.");
}

$pasien_id = $_SESSION['id'];

$sql = "
    SELECT
        p.id AS periksa_id,
        pas.nama_pas AS nama_pasien,
        d.doc_fname AS nama_dokter,
        p.total_biaya,
        DATE_FORMAT(p.tgl_periksa, '%Y-%m-%d %H:%i') AS tgl_periksa,
        p.catatan,
        GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS obat_dianjurkan
    FROM
        periksa p
    JOIN
        daftar_poli dp ON p.daftar_poli_id = dp.id
    JOIN
        jadwal_periksa jp ON dp.jadwal_dokter_id = jp.id
    JOIN
        his_docs d ON jp.dokter_id = d.doc_id
    JOIN
        pasien pas ON dp.pasien_id = pas.id
    LEFT JOIN
        detail_periksa dp2 ON p.id = dp2.periksa_id
    LEFT JOIN
        obat o ON dp2.obat_id = o.id
    WHERE
        dp.pasien_id = ?
    GROUP BY
        p.id
    ORDER BY
        p.tgl_periksa DESC
";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Query gagal diproses: " . $mysqli->error);
}

$stmt->bind_param("i", $pasien_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Riwayat Pemeriksaan</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Tanggal Periksa</th>
                    <th>Nama Dokter</th>
                    <th>Total Biaya</th>
                    <th>Catatan</th>
                    <th>Obat - Obat yang Didapat</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tgl_periksa']) ?></td>
                        <td><?= htmlspecialchars($row['nama_dokter']) ?></td>

                        <td>Rp <?= htmlspecialchars(number_format($row['total_biaya'], 2, ',', '.')) ?></td>
                        <td><?= htmlspecialchars($row['catatan']) ?></td>
                        <td>
                            <?php
                                // Menampilkan obat yang dianjurkan
                                if (!empty($row['obat_dianjurkan'])) {
                                    echo htmlspecialchars($row['obat_dianjurkan']);
                                } else {
                                    echo 'Tidak ada obat yang dianjurkan';
                                }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data pemeriksaan.</p>
    <?php endif; ?>

</body>
</html>

