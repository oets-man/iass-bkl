<?= $this->extend('layout/template_auth') ?>
<?= $this->section('content') ?>

<?= form_open('auth/login'); ?>
<div class="form-group position-relative has-icon-left">
    <label for="akun">Username</label>
    <div class="position-relative">
        <input type="text" class="form-control" id="akun" name="akun" placeholder="Masukkan akun atau username">
        <div class="form-control-icon">
            <!-- <i data-feather="user"></i> -->
            <i class="fas fa-user"></i>
        </div>
    </div>
</div>
<div class="form-group position-relative has-icon-left">
    <!-- <div class="clearfix"> -->
    <label for="password">Password</label>
    <!-- <a href="auth-forgot-password.html" class='float-end'>
            <small>Forgot password?</small>
        </a> -->
    <!-- </div> -->
    <div class="position-relative">
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password atau kata sandi">
        <div class="form-control-icon">
            <!-- <i data-feather="lock"></i> -->
            <i class="fas fa-lock"></i>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <!-- <button class="btn btn-primary float-end">Submit</button> -->
    </div>
</div>

<?= form_close(); ?>

<div class="card-footer mt-2 border-0">
    <div class="text-center">
        <a class="small" href="" onclick="alert('Hubungi Sdr Tijani Fattah');">Lupa Sandi?</a>
    </div>
    <div class="text-center">
        <a class="small" href="<?= base_url('auth/registrasi'); ?>">Belum punya akun? Registrasi!</a>
    </div>
</div>
<?= $this->endSection() ?>