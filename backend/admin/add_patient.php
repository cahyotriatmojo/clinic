<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_pas']))
      {
         $ad_fname=$_POST['nama_pas'];
			$no_ktp=$_POST['no_ktp'];
			$no_hp=$_POST['no_hp'];

            //sql to insert captured values
             $query="insert into pasien (nama_pas, no_ktp, no_hp) values(?,?,?)";
             $stmt = $mysqli->prepare($query);
             $stmt->bind_param('sss', $ad_fname, $no_ktp, $no_hp);
             $stmt->execute();
                     /*
         *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
         *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
         */
         //declare a varible which will be passed to alert function
         if($stmt)
         {
            $success = "Patient Details Added";
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
                                            <li class="breadcrumb-item active">Add Doctor</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Doctor Details</h4>
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
                                                    <label for="inputEmail4" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" name="nama_pas" class="form-control" placeholder="Enter your Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">HP Number</label>
                                                    <input required="required" type="number" class="form-control" name="no_hp" placeholder="Enter your Phone Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">KTP Number</label>
                                                    <input required="required" type="number" name="no_ktp" class="form-control" placeholder="Enter your KTP Number">
                                                </div>
                                            </div>

                                            <button type="submit" name="add_pas" class="ladda-button btn btn-success" data-style="expand-right">Add Patient</button>
                                        </form>
                                        <!--End Patient Form-->
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