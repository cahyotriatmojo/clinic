<?php
    session_start();
    require 'assets/inc/config.php';
    $conn = mysqli_connect($host, $dbuser, $dbpass, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    include('assets/inc/checklogin.php');
    check_login();
    $doc_id = $_SESSION['doc_id']; // Ambil ID dokter dari sesi login

    // Query untuk mendapatkan data pasien yang mendaftar pada dokter ini
    $sql = "SELECT dp.*, p.nama_pas AS nama_pasien, poli.nama_poli
    FROM daftar_poli dp
    JOIN pasien p ON dp.pasien_id = p.id
    JOIN poli ON dp.poli_poli = poli.id
    JOIN jadwal_periksa jd ON dp.jadwal_dokter_id = jd.id
    WHERE jd.dokter_id = '$doc_id'";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>

<?php include('assets/inc/head.php');?>

    <body>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">View Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Patient Details</h4>
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
                                                <th>#</th>
                                                <th data-toggle="true">Patient Name</th>
                                                <th data-hide="phone">Poli</th>
                                                <th data-hide="phone">Keluhan</th>
                                                <th data-hide="phone">Tanggal Daftar</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>
                                            <?php
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $row['nama_pasien']; ?></td>
                                                        <td><?php echo $row['nama_poli']; ?></td>
                                                        <td><?php echo $row['keluhan']; ?></td>
                                                        <td><?php echo $row['tanggal_daftar']; ?></td>
                                                        <td>
                                                            <a href="form_periksa.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Periksa</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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
                                    </div> <!-- end .table-responsive-->
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

    </body>

</html>