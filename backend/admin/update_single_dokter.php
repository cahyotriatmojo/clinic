<?php
	session_start();
	include('assets/inc/config.php');
    if (isset($_POST['update_doc'])) {
        $doc_id = $_GET['doc_id'];
        $doc_fname = $_POST['doc_fname'];
        $doc_number = $_POST['doc_number'];
        $doc_email = $_POST['doc_email'];
        $poli_id = $_POST['poli_id'];
        $doc_pwd = sha1(md5($_POST['doc_pwd']));

        // Cek dan proses file gambar
        if (!empty($_FILES["doc_dpic"]["name"])) {
            $doc_dpic = $_FILES["doc_dpic"]["name"];
            move_uploaded_file($_FILES["doc_dpic"]["tmp_name"], "../doc/assets/images/users/" . $doc_dpic);
        } else {
            // Tetap gunakan gambar lama jika tidak ada gambar baru
            $doc_dpic_query = "SELECT doc_dpic FROM his_docs WHERE doc_id = ?";
            $stmt_dpic = $mysqli->prepare($doc_dpic_query);
            $stmt_dpic->bind_param('i', $doc_id);
            $stmt_dpic->execute();
            $result_dpic = $stmt_dpic->get_result();
            $doc_dpic = $result_dpic->fetch_object()->doc_dpic ?? '';
        }

        // SQL untuk update
        $query = "UPDATE his_docs SET doc_fname=?, doc_number=?, poli_id=?, doc_email=?, doc_pwd=?, doc_dpic=? WHERE doc_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssssi', $doc_fname, $doc_number, $poli_id, $doc_email, $doc_pwd, $doc_dpic, $doc_id);

        if($stmt->execute()) {
            $success = "Doctor Updated";
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }

?>
<!--End Server Side-->
<!DOCTYPE html>
<html lang="en">

    <!--Head-->
    <?php include('assets/inc/head.php');?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Doctor</a></li>
                                            <li class="breadcrumb-item active">Manage Doctor</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Doctor Details</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- Form row -->
                        <?php
                            $doc_id=$_GET['doc_id'];
                            $ret="SELECT  * FROM his_docs WHERE doc_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$doc_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Patient Form-->
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" value="<?php echo $row->doc_fname;?>" name="doc_fname" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Number HP</label>
                                                    <input required="required" type="text" value="<?php echo $row->doc_number;?>" name="doc_number" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Email</label>
                                                    <input required="required" value="<?php echo $row->doc_email;?>" class="form-control" name="doc_email" id="inputAddress">
                                                </div>

                                                <div class="form-group col-md-6">
                                                <label for="input" class="col-form-label">Pilih Poli</label>
                                                <select class="form-control" name="poli_id" required>
                                                    <option value="<?php echo $row->poli_id; ?>">
                                                        <?php
                                                        // Menampilkan nama poli yang sedang disimpan
                                                        $current_poli_query = "SELECT nama_poli FROM poli WHERE id = ? AND deleted_at IS NULL";
                                                        $current_stmt = $mysqli->prepare($current_poli_query);
                                                        $current_stmt->bind_param('i', $row->poli_id);
                                                        $current_stmt->execute();
                                                        $current_result = $current_stmt->get_result();
                                                        if ($current_poli = $current_result->fetch_object()) {
                                                            echo $current_poli->nama_poli;
                                                        } else {
                                                            echo "Poli tidak ditemukan";
                                                        }
                                                        $current_stmt->close();
                                                        ?>
                                                    </option>
                                                    <?php
                                                    // Menampilkan semua poli aktif (deleted_at IS NULL)
                                                    $poli_query = "SELECT id, nama_poli FROM poli WHERE deleted_at IS NULL";
                                                    $poli_stmt = $mysqli->prepare($poli_query);
                                                    $poli_stmt->execute();
                                                    $poli_result = $poli_stmt->get_result();
                                                    while ($poli = $poli_result->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $poli->id; ?>">
                                                            <?php echo $poli->nama_poli; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    $poli_stmt->close();
                                                    ?>
                                                </select>
                                            </div>


                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">Password</label>
                                                    <input required="required"  type="password" name="doc_pwd" class="form-control" id="inputCity">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">Profile Picture</label>
                                                    <input type="file" name="doc_dpic" class="btn btn-success form-control" id="inputCity">
                                                    <img src="../doc/assets/images/users/<?php echo $row->doc_dpic; ?>" alt="Current Profile Picture" style="width:100px;height:100px;margin-top:10px;">
                                                </div>
                                            </div>

                                            <button type="submit" name="update_doc" class="ladda-button btn btn-success" data-style="expand-right">Update Doctor</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <?php }?>

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

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>

    </body>

</html>