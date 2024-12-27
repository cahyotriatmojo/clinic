
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Riwayat Pasien yang Diperiksa</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>No KTP</th>
                <th>Tanggal Periksa</th>
                <th>Total Biaya</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody id="riwayat-table">
            <!-- Data akan dimuat di sini -->
        </tbody>
    </table>

    <script>
        // Fetch data riwayat pasien
        $(document).ready(function () {
            $.ajax({
                url: "manage_pasien.php",
                method: "GET",
                success: function (response) {
                    const riwayat = JSON.parse(response);
                    let html = "";

                    if (riwayat.length === 0) {
                        html = "<tr><td colspan='6'>Tidak ada data riwayat.</td></tr>";
                    } else {
                        riwayat.forEach((item, index) => {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.nama_pas}</td>
                                    <td>${item.no_ktp}</td>
                                    <td>${item.tgl_periksa}</td>
                                    <td>${item.total_biaya}</td>
                                    <td>${item.catatan}</td>
                                </tr>
                            `;
                        });
                    }

                    $("#riwayat-table").html(html);
                },
                error: function () {
                    alert("Gagal memuat data riwayat pasien.");
                }
            });
        });
    </script>
</body>
</html>
