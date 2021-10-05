<?= $this->extend('layout/template_auth') ?>
<?= $this->section('content') ?>

<?php
$session = session();
$errors = $session->getFlashdata('errors');
// $success = $session->getFlashdata('success');
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
    // unset($_SESSION['errors']);
    $session->remove('errors');
endif;
?>
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-sm">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
            </div>
            <?php //helper('form'); 
            ?>
            <?= form_open('auth/registrasi'); ?>
            <!-- <= csrf_field(); ?> -->
            <!-- row 1 -->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input required name="email" type="email" class="form-control" id="" placeholder="Alamat Email">
                </div>
                <div class="col-sm-6">
                    <input name="nama" type="text" class="form-control" id="" placeholder="Nama Lengkap">
                </div>
            </div>

            <!-- row 2 -->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="jabatan" type="text" class="form-control" id="" placeholder="Jabatan">
                </div>
                <div class="col-sm-6">
                    <select required name="role_id" class="form-control " id="">
                        <option selected>Pilih Role</option>
                        <?php foreach ($role->getResult() as $key => $row) : ?>
                            <option value="<?= $row->id; ?>"><?= $row->id; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- row 3 -->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control" id="" placeholder="Sandi">
                </div>
                <div class="col-sm-6">
                    <input name="passwordR" type="password" class="form-control" id="" placeholder="Ulangi Sandi">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Daftar</button>

            <?= form_close(); ?>
            <hr>
            <div class="text-center">
                <a class="small" href="" onclick="alert('Hubungi Sdr Tijani');">Lupa Sandi?</a>
            </div>
            <div class="text-center">
                <a class="small" href="<?= base_url('auth/login'); ?>">Sudah punya akun? Login!</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>