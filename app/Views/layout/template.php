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

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- panggil session auth-->
    <?php
    $email      = session('user_email');
    $nama       = session('user_nama');
    $role_id    = session('role_id');
    $role_level = session('role_level'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:orange">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-landmark"></i>
                </div>
                <div class="sidebar-brand-text mx-3">IASS<sup> bkl</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <?php
            $db = \Config\Database::connect();
            //query user_access
            $qMenuHead = $db->query(
                "SELECT DISTINCT user_menu_view.menu
                FROM user_access
                INNER JOIN user_menu_view
                    ON user_access.menu_id = user_menu_view.id
                WHERE user_access.role_id = '$role_id'
                ORDER BY user_menu_view.urut ASC"
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
                     FROM user_menu_view
                     INNER JOIN user_access
                     ON user_menu_view.id = menu_id
                     WHERE
                        (
                            menu = '$m' AND
                            role_id = '$role_id'
                        )
                     ORDER BY urut ASC"
                );
                $menuSub = $qMenuSub->getResult();
                ?>

                <?php foreach ($menuSub as $sub) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . "/" . $sub->url; ?>" style="padding-top: 4px; padding-bottom: 8px;">
                            <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                            <?= $sub->icon; ?>
                            <span><?= $sub->title; ?></span>
                        </a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nama; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets'); ?>/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user/profile') . '/' . $email; ?>">
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
            <footer class="sticky-footer bg-white" style="padding: 10px;">
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
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>


    <!-- TABEL table -->
    <!-- Page level plugins -->
    <script src="<?= base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>



</body>

</html>