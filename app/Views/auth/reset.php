<?= $this->extend('layout/template_auth') ?>
<?= $this->section('content') ?>

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


<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-sm">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">GANTI KATA SANDI</h1>
            </div>

            <?= form_open('auth/reset', 'class="user"'); ?>
            <!-- <= csrf_field(); ?> -->
            <div class="form-group">
                <?php
                if (isset($email)) {
                    $e = $email;
                } else {
                    $e = "";
                }; ?>
                <input name="email" type="email" class="form-control form-control-user text-center" id="" value="<?= $e; ?>" placeholder="Masukkan email">
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control form-control-user text-center" id="" placeholder="Masukkan kata sandi lama">
            </div>
            <div class="form-group">
                <input name="passwordN" type="password" class="form-control form-control-user text-center" id="" placeholder="Masukkan kata sandi baru">
            </div>
            <div class="form-group">
                <input name="passwordR" type="password" class="form-control form-control-user text-center" id="" placeholder="Ulangi kata sandi baru">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-user">Ganti Kata Sandi</button>
            <?= form_close(); ?>
            <hr>
            <div class="text-center">
                <a class="small" href="" onclick="alert('Hubungi Sdr Tijani');">Lupa Sandi?</a>
            </div>
            <div class="text-center">
                <a class="small" href="<?= base_url('auth/registrasi'); ?>">Belum punya akun? Daftar!</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>