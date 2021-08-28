<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    $iass = "IASS Bangkalan";
    if (!isset($title)) {
        $title = $iass;
    } else {
        $title = $iass . ' / ' . $title;
    }; ?>
    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- ?xxxxxxxxxxxxxxxxxxx -->
    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:orange">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">IASS<sup> bkl</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <?php
            $role_id = session('role_id');
            // pindah ke filter
            // if (is_null($role_id)) {
            //     session()->setFlashData('errors', array('Silakan login terlebih dahulu'));
            //     $location = base_url('auth/login');
            //     header("location: $location");
            //     exit;
            // }
            $db = \Config\Database::connect();

            //query user
            $email = session('email');
            $user = $db->table('user')->where('email', $email)->get()->getFirstRow();

            //query user_access
            $qMenuHead = $db->query(
                "SELECT DISTINCT  user_menu.menu
    			 FROM user_access
	    		 INNER JOIN user_menu
		       		ON user_access.menu_title = user_menu.title
			     WHERE (user_access.role_id = '$role_id')"
            );
            $menuHead = $qMenuHead->getResult();
            foreach ($menuHead as $menu) : ?>
                <div class="sidebar-heading">
                    <?= $menu->menu; ?>
                </div>

                <!-- Nav Item - Dashboard -->
                <?php
                //query user_menu
                $m = $menu->menu;
                $qMenuSub = $db->query(
                    "SELECT *
                     FROM user_menu
                     INNER JOIN user_access
                        ON user_menu.title = user_access.menu_title
                     WHERE
                        (
                            user_menu.menu = '$m' AND
                            user_access.role_id = '$role_id'
                        )
                     ORDER BY user_menu.urut ASC"
                );
                $menuSub = $qMenuSub->getResult();
                ?>

                <?php foreach ($menuSub as $sub) : ?>
                    <?php $url = str_replace('@email', $user->email, $sub->url); ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . "/" . $url; ?>" style="padding-top: 4px; padding-bottom: 8px;">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span><?= $sub->title; ?></span></a>
                    </li>
                <?php endforeach; ?>

                <!-- Divider -->
                <hr class="sidebar-divider">
            <?php endforeach; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h1 class="h3 d-none d-sm-inline-block form-inline mr-auto ml-md-2 my-2 my-md-0 text-gray-400">Ikatan Alumni Santri Sidogiri Wilayah Bangkalan (<?= $role_id; ?>)</h1>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->nama; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets'); ?>/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- load content -->
                    <!-- ISI -->
                    <?= $this->renderSection('content') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; oets <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-danger">
                    <h5>Yakin akan keluar?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="width: 75px;">Tidak</button>
                    <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>" style="width: 75px;">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>


    <!-- TABEL table -->
    <!-- Page level plugins -->
    <script src="<?= base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- custom scripts -->
    <script>
        $(document).ready(function() {
            // $('#tabelUser').DataTable();
        });
    </script>

</body>

</html>