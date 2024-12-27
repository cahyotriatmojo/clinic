<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['doctor_sup']))
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
				$success = "dokters Details Added";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Hospital Management Information System -doktertem</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!--Load Sweet Alert Javascript-->
        <script src="assets/js/swal.js"></script>
        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $success;?>","success").then(function() {
                                    window.location.href = 'index.php';
                                });
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed","<?php echo $err;?>","Failed");
                            },
                                100);
                </script>

        <?php } ?>

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="his_admin_register.php">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Dokter Don't have an account? Create your account, it takes less than a minute</p>
                                </div>

                                <form  method='post'>

                                    <div class="form-group">
                                        <label for="fullname">First Name</label>
                                        <input class="form-control" type="text"  name = "doc_fname" id="fullname" placeholder="Enter your name" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="emailaddress">Number</label>
                                        <input class="form-control" name="doc_number" type="text" required placeholder="Enter your email">
                                    </div>     
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" name="doc_email" type="email" required placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" name="doc_pwd" type="password" required id="password" placeholder="Enter your password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Poli</label>
                                        <select class="form-control" name="poli_id" required placeholder="Enter your password">
                                            <option value="">Select Poli</option>
                                            <?php
                                                //get poli
                                                $ret="SELECT * FROM poli "; 
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
                                    
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="doctor_sup" type="submit"> Sign Up </button>
                                    </div>

                                </form>
                                <!--Lets Disable This For We tryna implement it in later versions of this system
                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="index.php" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!--Footer-->
            <?php include("assets/inc/footer1.php");?>
        <!-- End Footer-->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>