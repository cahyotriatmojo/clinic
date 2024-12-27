<?php
session_start();
include 'assets/inc/config.php'; // Sesuaikan path ke file koneksi

// Periksa apakah dokter sudah login
if (!isset($_SESSION['doc_id'])) {
    header("Location: index.php");
    exit();
}

$dokter_id = $_SESSION['doc_id']; // Ambil dokter ID dari session

// Query untuk mengambil riwayat pasien
$sql = "SELECT
            per.id AS periksa_id,
            pas.nama_pas AS nama_pas,
            pas.no_ktp,
            per.tgl_periksa,
            per.total_biaya,
            per.catatan
        FROM
            periksa per
        JOIN
            daftar_poli dp ON per.daftar_poli_id = dp.id
        JOIN
            jadwal_periksa jp ON dp.jadwal_dokter_id = jp.id
        JOIN
            pasien pas ON dp.pasien_id = pas.id
        WHERE
            jp.dokter_id = ?
        ORDER BY
            per.tgl_periksa DESC";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Query gagal diproses: " . $mysqli->error);
}

$stmt->bind_param("i", $dokter_id);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php');?>

    <body>
    <?php if ($result->num_rows > 0): ?>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmaceuticals</a></li>
                                            <li class="breadcrumb-item active">View Pharmaceuticals</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pharmaceuticals</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >

                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
        <thead>
            <tr>
                <th data-hide="phone">Tanggal Periksa</th>
                <th data-toggle="true">Nama Pasien</th>
                <th data-hide="phone">No KTP</th>
                <th data-hide="phone">Total Biaya</th>
                <th data-hide="phone">Catatan Periksa</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['tgl_periksa']) ?></td>
                    <td><?= htmlspecialchars($row['nama_pas']) ?></td>
                    <td><?= htmlspecialchars($row['no_ktp']) ?></td>
                    <td>Rp <?= number_format($row['total_biaya'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['catatan']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="8">
                    <div class="text-right">
                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
 <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                 <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    <?php else: ?>
        <p>Tidak ada data pemeriksaan.</p>
    <?php endif; ?>

    </body>
</html>