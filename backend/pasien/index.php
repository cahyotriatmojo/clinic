<?php

   session_start();
   include('assets/inc/config.php'); // Dapatkan file konfigurasi

   if (isset($_POST['pasien_login'])) {
       $no_ktp = $_POST['no_ktp']; // Ambil nomor KTP
       $no_hp = $_POST['no_hp'];   // Ambil nomor HP

       // Query untuk memeriksa pasien berdasarkan no_ktp dan no_hp
       $stmt = $mysqli->prepare("SELECT no_ktp, no_hp, id FROM pasien WHERE no_ktp = ? AND no_hp = ?");
       $stmt->bind_param('ss', $no_ktp, $no_hp); // Bind parameter
       $stmt->execute(); // Eksekusi query
       $stmt->bind_result($fetched_ktp, $fetched_hp, $fetched_id); // Bind hasil query

       $rs = $stmt->fetch(); // Ambil hasil query

       if ($rs) {
           // Login berhasil, set session
           $_SESSION['id'] = $fetched_id; // Simpan ID pasien ke session
           $_SESSION['no_ktp'] = $fetched_ktp;  // Simpan nomor KTP ke session

           // Redirect ke halaman tertentu
           header("Location: add_poli.php");
           exit();
       } else {
           // Login gagal, tampilkan pesan error
           $err = "Access Denied. Please Check Your Credentials.";
       }
   }

?>
<!--End Login-->
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Hospital Management System -A Super Responsive Information System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
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
                                swal("Success","<?php echo $success;?>","success");

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
                                    <a href="index.php">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access Pasien panel.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Nomer ktp</label>
                                        <input class="form-control" name="no_ktp" type="number" id="emailaddress" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">NomeHp</label>
                                        <input class="form-control" name="no_hp" type="number" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-dark btn-block" name="pasien_login" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <!-- <p> <a href="his_admin_pwd_reset.php" class="text-white-50 ml-1">Forgot your password?</a></p> -->
                               <p class="text-white-50">Don't have an account? <a href="pas_register.php" class="text-white ml-1"><b>Sign Up</b></a></p>
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


        <?php include ("assets/inc/footer1.php");?>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>

</html>