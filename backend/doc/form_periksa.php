<?php
require 'assets/inc/config.php';
// Tangkap id dari query string
$daftar_poli = isset($_GET['id']) ? $_GET['id'] : null;

// Jika id tidak ditemukan, tampilkan pesan error atau redirect
if ($daftar_poli === null) {
    echo "ID tidak ditemukan!";
    exit();
}

// Lakukan query untuk mendapatkan data pasien berdasarkan daftar_poli
$query = "SELECT * FROM daftar_poli WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $daftar_poli);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
    <html lang="en">

    <?php include('assets/inc/head.php');?>

    <style>
        .selected-obat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 5px;
            background-color: #f9f9f9;
        }
        .selected-obat button {
            margin-left: 10px;
        }
    </style>

    <body>
    <?php
    // Query untuk mengambil daftar obat
    $query_obat = "SELECT * FROM obat WHERE deleted_at IS NULL";
    $result_obat = $mysqli->query($query_obat);
    ?>

<div class="container my-4">
    <h2>Form Pemeriksaan Pasien</h2>
    <form action="proses_periksa.php" method="POST">
        <!-- ID Antrian dari daftar_poli -->
        <div class="mb-3">
            <label for="daftar_poli_id" class="form-label">ID Antrian Pasien</label>
            <input type="text" name="daftar_poli_id" id="daftar_poli_id" class="form-control" value="<?= $daftar_poli; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="daftar_poli_id" class="form-label">Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" class="form-control">
        </div>
        <div id="hidden-obat-inputs"></div>

<!-- Pilih Obat -->
<div class="mb-3">
    <label for="obat" class="form-label">Pilih Obat</label>
    <select name="obat-select" id="obat" class="form-control" multiple>
        <?php while ($row_obat = $result_obat->fetch_assoc()) { ?>
            <option value="<?= $row_obat['id']; ?>" data-harga="<?= $row_obat['harga']; ?>">
                <?= $row_obat['nama_obat']; ?> - Rp <?= number_format($row_obat['harga'], 2); ?>
            </option>
        <?php } ?>
    </select>
</div>

        <h4>Obat yang Dipilih:</h4>
        <div id="selected-obat-list" class="mb-3" name="obat[]" ></div>

        <!-- Total Biaya -->
        <div class="mb-3">
            <label for="total_biaya" class="form-label">Total Biaya</label>
            <input type="number" name="total_biaya" id="total_biaya" class="form-control" step="0.01" readonly>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea type="text" name="catatan" id="catatan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
    </form>
</div>

        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    <script>
    const obatSelect = document.getElementById('obat');
    const selectedObatList = document.getElementById('selected-obat-list');
    const totalBiayaInput = document.getElementById('total_biaya');
    const hiddenObatInputs = document.getElementById('hidden-obat-inputs');

    let totalBiaya = 0;
    const biayaDokter = 150000;

    // Event listener saat obat dipilih
    obatSelect.addEventListener('change', function () {
        const selectedOption = obatSelect.options[obatSelect.selectedIndex];
        const obatId = selectedOption.value;
        const obatName = selectedOption.textContent;
        const obatHarga = parseFloat(selectedOption.dataset.harga);

        if (obatId && !document.getElementById(`obat-${obatId}`)) {
            // Tambahkan elemen ke daftar obat yang dipilih
            const obatItem = document.createElement('div');
            obatItem.className = 'selected-obat';
            obatItem.id = `obat-${obatId}`;
            obatItem.innerHTML = `
                <span>${obatName}</span>
                <button class="btn btn-danger btn-sm" onclick="hapusObat(${obatId}, ${obatHarga})">Hapus</button>
            `;

            selectedObatList.appendChild(obatItem);

            // Tambahkan input hidden untuk obat
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'obat[]'; // Array input untuk semua obat
            hiddenInput.id = `hidden-obat-${obatId}`;
            hiddenInput.value = obatId;
            hiddenObatInputs.appendChild(hiddenInput);

            // Tambahkan ke total biaya
            totalBiaya += obatHarga;
            updateTotalBiaya();
        } else {
            alert('Obat ini sudah dipilih.');
        }

        // Reset pilihan select
        obatSelect.value = "";
    });

    // Fungsi untuk menghapus obat dari daftar
    function hapusObat(obatId, obatHarga) {
        const obatItem = document.getElementById(`obat-${obatId}`);
        const hiddenInput = document.getElementById(`hidden-obat-${obatId}`);
        if (obatItem && hiddenInput) {
            selectedObatList.removeChild(obatItem);
            hiddenObatInputs.removeChild(hiddenInput);
            totalBiaya -= obatHarga;
            updateTotalBiaya();
        }
    }

    // Fungsi untuk memperbarui total biaya
    function updateTotalBiaya() {
        const totalBiayaDenganDokter = totalBiaya + biayaDokter;
        totalBiayaInput.value = totalBiayaDenganDokter.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', updateTotalBiaya);
    </script>

    </body>
</html>