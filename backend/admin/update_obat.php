
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_obat']))
		{
			$id = $_GET['id'];
			$harga=$_POST['harga'];
            $nama_obat=$_POST['nama_obat'];
            
            //sql to update captured values
			$query="UPDATE obat SET nama_obat=?, harga=? WHERE id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sss', $nama_obat, $harga, $id);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Obat Upadated ";
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
                $id=$_GET['id'];
                $ret="SELECT  * FROM obat WHERE id=?";
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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Obat</a></li>
                                            <li class="breadcrumb-item active">Update Obat-Obatan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Obat</h4>
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
                                            <div class="form-row" >
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label">Nama Obat</label>
                                                    <input required="required" value="<?php echo $row->nama_obat;?>" type="text" name="nama_obat" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label">Harga Obat</label>
                                                    <input required="required" value="<?php echo $row->harga;?>" type="number" name="harga" class="form-control">
                                                </div>
                                            </div>

                                           <button type="submit" name="update_obat" class="ladda-button btn btn-danger" data-style="expand-right">Update Obat</button>

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

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
                <?php }?>

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