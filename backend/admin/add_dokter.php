<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_doc']))
		{
			$doc_fname=$_POST['doc_fname'];
			$doc_email=$_POST['doc_email'];
            $doc_pwd=sha1(md5($_POST['doc_pwd']));//double encrypt to increase security
            $doc_number = $_POST['doc_number'];
            $poli_id = $_POST['poli_id'];
            //sql to insert captured values
			$query="insert into his_docs (doc_fname, doc_email, doc_pwd, doc_number, poli_id) values(?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('sssss', $doc_fname, $doc_email, $doc_pwd, $doc_number, $poli_id);
            $stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Doctor Details Added";
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
                                                    <input type="text" required="required" name="doc_fname" class="form-control" placeholder="Enter your name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Email</label>
                                                    <input required="required" type="email" class="form-control" name="doc_email" placeholder="Enter your email">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">Password</label>
                                                    <input required="required" type="password" name="doc_pwd" class="form-control" placeholder="Enter your password">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="password">Poli</label>
                                                    <select class="form-control" name="poli_id" required>
                                                    <option value="">Select Poli</option>
                                                    <?php
                                                        //get poli
                                                        $ret="SELECT * FROM poli WHERE deleted_at IS NULL";
                                                        $stmt= $mysqli->prepare($ret) ;
                                                        $stmt->execute();
                                                        $res=$stmt->get_result();
                                                        while($poli=$res->fetch_object())
                                                        {
                                                    ?>
                                                        <option value="<?php echo $poli->id;?>"><?php echo $poli->nama_poli;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                                 <div class="form-group col-md-6">
                                                    <label for="emailaddress">Number</label>
                                                    <input class="form-control" name="doc_number" type="number" required placeholder="Enter your Number HP">
                                                </div>
                                            </div>

                                            <button type="submit" name="add_doc" class="ladda-button btn btn-success" data-style="expand-right">Add Doctor</button>

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