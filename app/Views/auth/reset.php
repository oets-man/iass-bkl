<?= $this->extend('layout/template_auth') ?>
<?= $this->section('content') ?>


<!-- Nested Row within Card Body -->

<?= form_open('auth/reset', 'class="user"'); ?>
<!-- <= csrf_field(); ?> -->
<div class="form-group">
    <?php
    // if (isset($akun)) {
    //     $e = $akun;
    // } else {
    //     $e = "";
    // }; 
    ?>
    <input name="akun" type="text" class="form-control" value="<?= $akun; ?>" placeholder="Masukkan akun">
</div>

<div class="form-group">
    <input name="passwordO" type="password" class="form-control" placeholder="Masukkan kata sandi lama">
</div>
<div class="form-group">
    <input name="password" type="password" class="form-control" placeholder="Masukkan kata sandi baru">
</div>
<div class="form-group">
    <input name="passwordR" type="password" class="form-control" placeholder="Ulangi kata sandi baru">
</div>

<div class="input-group">
    <!-- <div class="input-group-prepend">
        <a href="javascript:history.back()" class="btn btn-outline-success"><i class="fas fa-share fa-flip-horizontal"></i></a>
    </div> -->
    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-lock"></i><span class="ms-1"> Ganti Password</span></button>
</div>

<?= form_close(); ?>

<div class="text-center mt-2">
    <a href="javascript:history.back()" class="btn btn-outline-success btn-block"><i class="fas fa-share fa-flip-horizontal"></i> Kembali</a>
</div>
<?= $this->endSection() ?>