<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $doc_id = $_SESSION['doc_id'];

?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Doctors</a></li>
                                            <li class="breadcrumb-item active">Manage Doctors</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Doctors </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >

                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true"> Hari</th>
                                                <th data-hide="phone">Jam Mulai</th>
                                                <th data-hide="phone">Jam Selesai</th>
                                                <th data-hide="phone">Status</th>
                                                <th data-hide="phone">Action</th>
                                                <th data-hide="phone">Edit Status</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $current_date = new DateTime();

                                            $ret = "SELECT * FROM jadwal_periksa WHERE dokter_id = ? ORDER BY RAND()";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $doc_id);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                                $jadwal_periksa = $row->hari . ' ' . $row->jam_mulai;
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlspecialchars($row->hari); ?></td>
                                                    <td><?php echo htmlspecialchars($row->jam_mulai); ?></td>
                                                    <td><?php echo htmlspecialchars($row->jam_selesai); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo ($row->status == 'aktif') ? 'success' : 'danger'; ?>">
                                                            <?php echo ucfirst($row->status); ?>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <a href="his_doc_view_single_pharm.php?phar_bcode=<?php echo $row->phar_bcode; ?>"
                                                           class="badge badge-success">
                                                           <i class="far fa-eye"></i> View
                                                        </a>
                                                        <a href="update_jadwal.php?id=<?php echo $row->id; ?>"
                                                           class="badge badge-warning">
                                                           <i class="fas fa-clipboard-check"></i> Update
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <?php if ($row->status == 'aktif') { ?>
                                                            <span class="badge badge-success">Aktif</span>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);"
                                                            onclick="toggleStatus(<?php echo $row->id; ?>, '<?php echo $row->status; ?>', '<?php echo $jadwal_periksa; ?>')"
                                                            class="badge badge-warning">Aktifkan</a>
                                                        <?php } ?>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        <?php $cnt++; } ?>
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
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

    <script>
    function toggleStatus(id, currentStatus, jadwalPeriksa) {
        // Ambil waktu saat ini
        const currentDate = new Date();

        // Ambil waktu jadwal periksa
        const scheduleDate = new Date(jadwalPeriksa); // format: 'YYYY-MM-DD HH:mm:ss'

        // Hitung selisih waktu antara sekarang dan jadwal periksa dalam jam
        const timeDifference = (scheduleDate - currentDate) / (1000 * 3600); // dalam jam

        // Jika jadwal periksa sudah kurang dari 24 jam, batalkan perubahan
        if (timeDifference < 24) {
            alert("Tidak dapat mengubah status karena jadwal periksa sudah dekat.");
            return;
        }

        // Tentukan status baru
        const newStatus = (currentStatus === 'aktif') ? 'nonaktif' : 'aktif';
        const confirmMessage = `Apakah Anda yakin ingin mengubah status menjadi ${newStatus}?`;

        if (confirm(confirmMessage)) {
            // Tampilkan indikator loading
            const loadingMessage = document.createElement('p');
            loadingMessage.id = 'loadingMessage';
            loadingMessage.textContent = 'Memproses perubahan status...';
            document.body.appendChild(loadingMessage);

            fetch('toggle_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, status: newStatus }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Hapus pesan loading
                document.getElementById('loadingMessage').remove();

                if (data.success) {
                    alert('Status berhasil diperbarui!');
                    location.reload(); // Reload halaman untuk melihat perubahan
                } else {
                    alert('Gagal memperbarui status. Silakan coba lagi.');
                }
            })
            .catch(err => {
                // Hapus pesan loading jika ada error
                if (document.getElementById('loadingMessage')) {
                    document.getElementById('loadingMessage').remove();
                }
                console.error('Error:', err);
                alert('Terjadi kesalahan saat memperbarui status. Cek koneksi Anda atau hubungi administrator.');
            });
        }
    }
</script>


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>

</html>