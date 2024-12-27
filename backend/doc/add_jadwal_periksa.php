
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_jadwal']))
		{
			$doktor_id = $_SESSION['doc_id'];
            $hari = $_POST['hari'];
            $jam_mulai = $_POST['jam_mulai'];
            $jam_selesai = $_POST['jam_selesai'];

            $query = "INSERT INTO jadwal_periksa (dokter_id, hari, jam_mulai, jam_selesai) VALUES (?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('isss', $doktor_id, $hari, $jam_mulai, $jam_selesai);
            $stmt->execute();

			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Doctor  Added";
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
                                            <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Doctors</a></li>
                                            <li class="breadcrumb-item active">Add Doctor</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Create A Doctor</h4>
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
                                                    <label for="inputEmail4" class="col-form-label">Name Doktor</label>
                                                    <?php
                                                        $doc_id = $_SESSION['doc_id'];
                                                        $ret = "SELECT doc_fname FROM his_docs WHERE doc_id=?";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->bind_param('i', $doc_id);
                                                        $stmt->execute();
                                                        $res = $stmt->get_result();
                                                        while($row = $res->fetch_object()) {
                                                    ?>
                                                        <input type="text" required="required" name="dokter_id" class="form-control" id="inputEmail4" value="<?php echo $row->doc_fname;?>" readonly>
                                                    <?php } ?>

                                                </div>
                                            </div>

                                            <div class="form-row">
                                                 <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Hari</label>
                                                    <select required="required" name="hari" class="form-control" id="inputPassword4">
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jumat</option>
                                                        <option value="Sabtu">Sabtu</option>
                                                        <option value="Minggu">Minggu</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputJamMulai" class="col-form-label">Jam Mulai</label>
                                                    <input type="time" required="required" name="jam_mulai" class="form-control" id="inputJamMulai">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inputJamSelesai" class="col-form-label">Jam Selesai</label>
                                                    <input type="time" required="required" name="jam_selesai" class="form-control" id="inputJamSelesai">
                                                </div>
                                            </div>

                                           <button type="submit" name="add_jadwal" class="ladda-button btn btn-success" data-style="expand-right">Add Jadwal Dokter</button>

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