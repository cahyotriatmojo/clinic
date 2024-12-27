
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_jadwal']))
        {
            $id = $_GET['id'];
            $hari=$_POST['hari'];
            $jam_mulai=$_POST['jam_mulai'];
            $jam_selesai=$_POST['jam_selesai'];

            //sql to update captured values
            $query="UPDATE jadwal_periksa SET hari = ?, jam_mulai = ?, jam_selesai = ? WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ssss', $hari, $jam_mulai, $jam_selesai, $id);
            $stmt->execute();
            /*
            *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
            *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
            */
            //declare a varible which will be passed to alert function
            if($stmt)
            {
                $success = "Jadwal Updated";
            }
            else {
                $err = "Please Try Again Or Try Later";
            }
        }
?>
<!--End Server Side-->
<!--End Patient Registration-->
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
            <?php
                $id = $_GET['id'];
                $ret="SELECT  * FROM jadwal_periksa WHERE id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>
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
                                                <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Doctors</a></li>
                                                <li class="breadcrumb-item active">Manage Doctor</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Update Hari</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
                            <!-- Form row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Fill all fields</h4>
                                            <!--Add Patient Form-->
                                            <form method="post">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputHari" class="col-form-label">Hari</label>
                                                        <select name="hari" class="form-control" id="inputHari" required="required">
                                                            <option value="Senin" <?php if($row->hari == 'Senin') echo 'selected'; ?>>Senin</option>
                                                            <option value="Selasa" <?php if($row->hari == 'Selasa') echo 'selected'; ?>>Selasa</option>
                                                            <option value="Rabu" <?php if($row->hari == 'Rabu') echo 'selected'; ?>>Rabu</option>
                                                            <option value="Kamis" <?php if($row->hari == 'Kamis') echo 'selected'; ?>>Kamis</option>
                                                            <option value="Jumat" <?php if($row->hari == 'Jumat') echo 'selected'; ?>>Jumat</option>
                                                            <option value="Sabtu" <?php if($row->hari == 'Sabtu') echo 'selected'; ?>>Sabtu</option>
                                                            <option value="Minggu" <?php if($row->hari == 'Minggu') echo 'selected'; ?>>Minggu</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputJamMulai" class="col-form-label">Jam Mulai</label>
                                                        <input type="time" required="required" value="<?php echo $row->jam_mulai;?>" name="jam_mulai" class="form-control" id="inputJamMulai">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputJamSelesai" class="col-form-label">Jam Selesai</label>
                                                        <input type="time" required="required" value="<?php echo $row->jam_selesai;?>" name="jam_selesai" class="form-control" id="inputJamSelesai">
                                                    </div>
                                                </div>

                                            <button type="submit" name="update_jadwal" class="ladda-button btn btn-warning" data-style="expand-right">Update Doctors</button>

                                            </form>

                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->
                    <?php include('assets/inc/footer.php');?>
                    <!-- end Footer -->

                </div>
            <?php }?>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!--Load CK EDITOR Javascript-->
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>

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