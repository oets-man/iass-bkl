<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo csrf_hash(); ?>">
    <?php
    $iass = "IASS Bangkalan";
    if (!isset($title)) {
        $title = $iass;
    } else {
        $title = $iass . ' / ' . $title;
    }; ?>
    <title><?= $title; ?></title>

    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/assets_voler/css/bootstrap.css"> -->

    <link href="<?= base_url(); ?>/assets_voler/vendors/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets_voler/vendors/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets_voler/vendors/fontawesome-free/css/all.min.css" type="text/css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets_voler/vendors/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" type="text/css" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets_voler/css/app.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets_voler/images/favicon.svg" type="image/x-icon" rel="shortcut icon">

    <?= $this->renderSection('header') ?>

    <script src="<?= base_url(); ?>/assets_voler/vendors/jquery/jquery.min.js"></script>


    <style>
        h3.subjudul {
            font-weight: lighter;
            margin-top: 0;
            margin-bottom: 0;
        }

        .table> :not(caption)>*>* {
            padding: 0.5rem 1rem;
            /* background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg); */
        }
    </style>

</head>

<body>
    <!-- panggil session auth-->
    <?php
    $email      = session('user_email');
    $nama       = session('user_nama');
    $role_id    = session('role_id');
    $role_level = session('role_level'); ?>

    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="<?= base_url(); ?>/assets_voler/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <!-- menu -->
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
                            <div class="sidebar-title" style="padding-left: 24px; padding-bottom: 2;">
                                <?= $menu->menu; ?>
                            </div>
                            <!-- sidebar Item - Dashboard -->

                            <?php
                            //query user_submenu
                            $m = $menu->menu;
                            $qMenuSub = $db->query(
                                "SELECT *
                     FROM user_menu_view
                     INNER JOIN user_access
                     ON user_menu_view.id = menu_id
                     WHERE
                        (menu = '$m' AND role_id = '$role_id')
                     ORDER BY urut ASC"
                            );
                            $menuSub = $qMenuSub->getResult();
                            ?>

                            <?php foreach ($menuSub as $sub) : ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?= site_url($sub->url); ?>">
                                        <?= $sub->icon; ?>
                                        <span><?= $sub->title; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <!-- <div class='sidebar-title'>Home</div>
                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i data-feather="home" width="20"></i><span>Dashboard</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h2 class="ms-3 d-none d-sm-inline-block form-inline me-auto ms-md-2 my-md-0 text-primary" style="font-variant: small-caps;">Ikatan Alumni Santri Sidogiri (IASS) Wilayah Bangkalan</h2>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

                        <li class="nav-item">
                            <!-- <div class="nav-link"> -->
                            <a href="javascript:history.back()" class="btn btn-primary btn-sm"><i class="fas fa-share fa-flip-horizontal"></i><span class="ms-1 d-none d-lg-inline"> Kembali</span></a>
                            <!-- </div> -->
                        </li>

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="<?= base_url(); ?>/assets_voler/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block text-primary"><?= $nama; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="<?= site_url('user/profile') . '/' . $email; ?>"><i data-feather="user"></i> Profil</a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?= site_url('auth/logout'); ?>"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <!-- <div class="page-title">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
                </div> -->

                <!-- start flashdata -->
                <?php
                $session = session();
                $errors = $session->getFlashdata('errors');
                $success = $session->getFlashdata('success');
                if ($errors != null) : ?>
                    <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="my-0">
                            <?php foreach ($errors as $err) : ?>
                                <li><?= $err ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php
                    unset($_SESSION['errors']);
                endif;
                if ($success != null) : ?>
                    <div class="alert alert-success alert-dismissible fade show text-primary text-center" role="alert">
                        <strong><?= $success; ?></strong>
                    </div>
                <?php
                    unset($_SESSION['success']);
                endif;
                ?>
                <!-- end flashdata -->


                <?php
                // var_dump($_SERVER['PATH_INFO']);;
                // var_dump(session('komisariat'));;
                // echo stripos('avea', 'e');
                ?>
                <div class="card shadow">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>

            <!-- <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2020 &copy; Voler</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    <script src="<?= base_url(); ?>/assets_voler/vendors/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets_voler/js/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets_voler/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets_voler/js/app.js"></script>

    <script src="<?= base_url(); ?>/assets_voler/js/main.js"></script>

    <!-- datatables -->
    <script src="<?= base_url(); ?>/assets_voler/vendors/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/assets_voler/vendors/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <?= $this->renderSection('script') ?>

</body>

</html>