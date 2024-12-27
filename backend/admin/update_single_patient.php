<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_patient']))
		{
            $id = $_GET['id'];
			$nama_pas = $_POST['nama_pas'];
            $no_ktp = $_POST['no_ktp'];
            $no_hp = $_POST['no_hp'];
            $join_pas = $_POST['join_pas'];

            $sql = "UPDATE pasien SET nama_pas=?, no_ktp=?, no_hp=?, join_pas=? WHERE id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ssssi', $nama_pas, $no_ktp, $no_hp, $join_pas, $id);
            $stmt->execute();

            /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Patient Details Updated";
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">Manage Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Patient Details</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- Form row -->
                        <!--LETS GET DETAILS OF SINGLE PATIENT GIVEN THEIR ID-->
                        <?php
                            $id=$_GET['id'];
                            $ret="SELECT  * FROM pasien WHERE id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$id);
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
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Name</label>
                                                    <input type="text" required="required" value="<?php echo $row->nama_pas;?>" name="nama_pas" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" value="<?php echo $row->no_hp;?>" name="no_hp" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">KTP Number</label>
                                                    <input required="required" type="number" value="<?php echo $row->no_ktp;?>" name="no_ktp" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-2" style="display:none">
                                                    <?php
                                                        $length = 5;
                                                        $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                    <label for="inputZip" class="col-form-label">Patient Number</label>
                                                    <input type="text" name="pat_number" value="<?php echo $patient_number;?>" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">Date Of Joining</label>
                                                    <input type="text" readonly value="<?php echo $row->join_pas;?>" name="join_pas" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <button type="submit" name="update_patient" class="ladda-button btn btn-success" data-style="expand-right">Update Patient</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <?php  }?>
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