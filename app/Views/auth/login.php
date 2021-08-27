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


<?php
$email = [
    'name' => 'email',
    'placeholder' => 'Masukkan Email',
    'class' => 'form-control form-control-user',
    'type' => 'email',
    'style' => 'text-align: center',
    'required' => 'required'
];
$password = [
    'name' => 'password',
    'placeholder' => 'Kata Sandi',
    'class' => 'form-control form-control-user',
    'type' => 'password',
    'style' => 'text-align: center',
    'required' => 'required'
];
$submit = [
    'name' => 'submit',
    'value' => 'Login',
    'type' => 'submit',
    'class' => 'btn btn-primary btn-user btn-block'
]; ?>
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-sm">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
            </div>

            <?= form_open('auth/login', 'class="user"'); ?>
            <!-- <= csrf_field(); ?> -->
            <!-- row 1 -->
            <div class="form-group">
                <?= form_input($email); ?>
            </div>
            <div class="form-group">
                <?= form_password($password); ?>
            </div>
            <div class="form-group">
                <?= form_submit($submit); ?>
            </div>

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