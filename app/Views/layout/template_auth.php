<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $iass = "IASS Bangkalan";
    if (!isset($title)) {
        $title = $iass;
    } else {
        $title = $iass . ' / ' . $title;
    }; ?>
    <title><?= $title; ?></title>

    <link href="<?= base_url(); ?>/assets_voler/vendors/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets_voler/images/favicon-iass.svg" type="image/x-icon" rel="shortcut icon">
    <link href="<?= base_url(); ?>/assets_voler/css/app.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets_voler/vendors/fontawesome-free/css/all.min.css" type="text/css" rel="stylesheet">
    <script src="<?= base_url(); ?>/assets_voler/vendors/jquery/jquery.min.js"></script>


</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="<?= $heading == 'Daftar' ? 'col-md-8 col-sm-12 mx-auto' : 'col-md-4 col-sm-12 mx-auto'; ?>">
                    <div class="card">
                        <!-- start flashdata -->
                        <?php
                        $session = session();
                        $errors = $session->getFlashdata('errors');
                        $success = $session->getFlashdata('success');
                        if ($errors != null) : ?>
                            <div class="alert alert-light-warning color-danger alert-dismissible fade show" role="alert">
                                <h5 class="alert-heading">Terjadi Kesalahan!</h5>
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
                            <div class="alert alert-light-success color-primary alert-dismissible fade show text-center" role="alert">
                                <?= $success; ?>
                            </div>
                        <?php
                            unset($_SESSION['success']);
                        endif;
                        ?>
                        <!-- end flashdata -->

                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?= base_url(); ?>/assets_voler/images/logo.png" height="100" class='my-2'>
                                <h3><?= $heading; ?></h3>
                                <p><?= $caption; ?></p>
                            </div>
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?= base_url(); ?>/assets_voler/js/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets_voler/js/app.js"></script>
    <!-- <script src="<?= base_url(); ?>/assets_voler/js/main.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            var islog = <?= session('isLoggedIn'); ?>;
            if (islog) {
                $('.cek-login').attr('disabled', true);
            };
        });
    </script>
</body>

</html>