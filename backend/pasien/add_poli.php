<?php
	session_start();
    require_once 'assets/inc/config.php';

    $queryPoli = "SELECT * FROM poli WHERE deleted_at IS NULL ";
    $poliResult = $mysqli->query($queryPoli);
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
                                            <li class="breadcrumb-item active">Add Patient</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Patient Details</h4>
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
                                            <form method="post" action="janji_temu.php">
                                                <div class="form-row">
                                                <?php
                                                $pas_id = $_SESSION['id'];
                                                $query = "SELECT * FROM pasien WHERE id = '$pas_id'";
                                                $result = $mysqli->query($query);
                                                while ($row = $result->fetch_assoc()) { ?>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Nama Pasien</label>
                                                        <input type="hidden" class="form-control" id="inputEmail4" name="pasien_id" value="<?php echo $_SESSION['id']; ?>" readonly>
                                                        <input type="text" class="form-control" id="inputEmail4" name="nama_pasien" value="<?php echo ($row['nama_pas']); ?>" readonly>
                                                    <?php }?>
                                                    </div>


                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Pilih Poli</label>
                                                    <select required="required" class="form-control" name="poli_id" id="poli_id" onchange="fetchDokter(this.value)" required>
                                                        <option value="">Pilih Poli</option>
                                                        <?php while ($row = $poliResult->fetch_assoc()) { ?>
                                                            <option value="<?php echo ($row['id']); ?>"><?php echo ($row['nama_poli']); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="jadwal" class="col-form-label">Pilih Jadwal Praktek</label>
                                                    <select id="jadwal" required="required" name="jadwal_dokter_id" class="form-control">
                                                        <option value="">Pilih Dokter Terlebih Dahulu</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                        <label for="dokter_id" class="col-form-label">Pilih Dokter</label>
                                                        <select id="dokter_id" required="required" name="dokter_id" class="form-control">
                                                            <option value="">Pilih Poli Terlebih Dahulu</option>
                                                        </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                <label for="keluhan" class="col-form-label">Keluhan</label>
                                                <textarea id="keluhan" required="required" name="keluhan" class="form-control" rows="4" placeholder="Tuliskan keluhan pasien di sini"></textarea>
                                                </div>

                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="btn btn-primary btn-block" data-style="expand-right">Daftar Janji Temu</button>
                                            </div>

                                        </form>
                                        <!--End Patient Form-->

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
            <!-- ============================================================== --

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

        <script>
        function fetchDokter(poliId) {
            const dokterSelect = document.getElementById('dokter_id');
            dokterSelect.innerHTML = '<option value="">Memuat Dokter...</option>';

            if (poliId) {
                fetch(`fetch_dokter.php?poli_id=${poliId}`)
                    .then(response => response.json())
                    .then(data => {
                        dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
                        data.forEach(dokter => {
                            dokterSelect.innerHTML += `<option value="${dokter.doc_id}">${dokter.doc_fname}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching doctors:', error);
                        dokterSelect.innerHTML = '<option value="">Gagal memuat dokter</option>';
                    });
            } else {
                dokterSelect.innerHTML = '<option value="">Pilih Poli Terlebih Dahulu</option>';
            }
        }

        // Script untuk mengambil jadwal dokter berdasarkan dokter yang dipilih
        document.getElementById('dokter_id').addEventListener('change', function() {
            const dokterId = this.value;
            const jadwalSelect = document.getElementById('jadwal');

            jadwalSelect.innerHTML = '<option value="">Memuat Jadwal...</option>';

            if (dokterId) {
                fetch(`fetch_jadwal.php?dokter_id=${dokterId}`)
                    .then(response => response.json())
                    .then(data => {
                        jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                        data.forEach(jadwal => {
                            jadwalSelect.innerHTML += `<option value="${jadwal.id}">${jadwal.hari} - ${jadwal.jam_mulai} - ${jadwal.jam_selesai}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching jadwal:', error);
                        jadwalSelect.innerHTML = '<option value="">Gagal memuat jadwal</option>';
                    });
            } else {
                jadwalSelect.innerHTML = '<option value="">Pilih Dokter Terlebih Dahulu</option>';
            }
        });
    </script>

    </body>

</html>






