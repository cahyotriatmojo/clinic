<?php
require 'assets/inc/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pasien_id = $_POST['pasien_id']; // Otomatis dari sesi
  $poli_id = $_POST['poli_id'];
  $jadwal_dokter_id = $_POST['jadwal_dokter_id'];
  $tanggal_daftar = date('Y-m-d');
  $keluhan = $_POST['keluhan'];

  // Validasi pasien_id
  $query = "SELECT COUNT(*) AS count FROM pasien WHERE id = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('i', $pasien_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($row['count'] == 0) {
    die("Pasien ID tidak valid.");
  }

  // Validasi poli_id
  $query = "SELECT COUNT(*) AS count FROM poli WHERE id = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('i', $poli_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($row['count'] == 0) {
    die("Poli ID tidak valid.");
  }

  // Validasi jadwal_dokter_id
  $query = "SELECT COUNT(*) AS count FROM jadwal_periksa WHERE id = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('i', $jadwal_dokter_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($row['count'] == 0) {
    die("Jadwal Dokter ID tidak valid.");
  }

  // Hitung nomor antrian dengan format YYYYMMDD-NO
  $tgl_login = date('Ymd'); // Tanggal login (format: YYYYMMDD)
  $query = "SELECT COUNT(*) AS total_antrian FROM daftar_poli WHERE tanggal_daftar = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('s', $tanggal_daftar);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Generate nomor antrian
  $no_urutan = $row['total_antrian'] + 1;
  $no_antrian = $tgl_login . '-' . $no_urutan;

  if (empty($keluhan) || strlen($keluhan) < 10) {
      echo "Keluhan harus diisi dan minimal 10 karakter.";
      exit();
  }

  // Insert data janji temu
  $insert = "INSERT INTO daftar_poli (pasien_id, poli_poli, jadwal_dokter_id, no_antrian, tanggal_daftar, keluhan)
            VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $mysqli->prepare($insert);
  $stmt->bind_param('iiiiss', $pasien_id, $poli_id, $jadwal_dokter_id, $no_antrian, $tanggal_daftar, $keluhan);

  if ($stmt->execute()) {
      echo "Janji temu berhasil didaftarkan dengan nomor antrian: $no_antrian";
  } else {
      echo "Gagal mendaftarkan janji temu.";
  }

}
?>
