<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];

  // Set zona waktu lokal
    date_default_timezone_set('Asia/Jakarta');

    // Waktu sekarang dalam format 'Y-m-d H:i:s' (contoh: 2024-06-17 12:30:00)
    $now = date('Y-m-d H:i:s');

    // Simpan ke database
    if(isset($_GET['delete_obat'])) {
        $id = intval($_GET['delete_obat']);
        $adn = "UPDATE obat SET deleted_at = ? WHERE id = ? AND deleted_at IS NULL";
        $stmt = $mysqli->prepare($adn);
        $stmt->bind_param('si', $now, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Obat Record Deleted";
        } else {
            $err = "Record Not Found or Already Deleted";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                            <li class="breadcrumb-item active">Manage Obat-Obatan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Obat</h4>
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
                                                <th data-toggle="true">Nama Obat</th>
                                                <th data-hide="phone">Harga Obat</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>

                                            <?php
                                                $adn = "SELECT * FROM obat WHERE deleted_at IS NULL";
                                                $stmt = $mysqli->prepare($adn);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $cnt = 1;
                                                while ($row = $result->fetch_object()) {
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo $row->nama_obat; ?></td>
                                                            <td><?php echo $row->harga; ?></td>
                                                            <td>
                                                                <a href="view_single_obat.php?id=<?php echo $row->id; ?>" class="badge badge-success">
                                                                    <i class="far fa-eye"></i> View
                                                                </a>
                                                                <a href="update_obat.php?id=<?php echo $row->id; ?>" class="badge badge-warning">
                                                                    <i class="fas fa-clipboard-check"></i> Update
                                                                </a>
                                                                <a href="manage_obat.php?delete_obat=<?php echo $row->id; ?>" class="badge badge-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                <?php
                                                    $cnt++;
                                                }
                                                $stmt->close();
                                                ?>
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