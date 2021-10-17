<?= $this->extend('layout/template_auth') ?>
<?= $this->section('content') ?>


<!-- Nested Row within Card Body -->

<?= form_open('auth/registrasi'); ?>
<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input required name="nama" type="text" class="form-control" id="nama" placeholder="Nama lengkap" value="<?= old('nama'); ?>">
        </div>
    </div>
    <div class=" col-md-6 col-12">
        <div class="form-group">
            <label for="akun">Username</label>
            <input required type="text" id="akun" class="form-control" name="akun" placeholder="Nama akun atau username" value="<?= old('akun'); ?>">
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input required name="jabatan" type="text" class="form-control" id="jabatan" placeholder="Jabatan di IASS" value="<?= old('jabatan'); ?>">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="role_id">Role</label>
            <select required name="role_id" class="form-select" id="role_id" value="<?= old('role_id'); ?>" title="Tentukan komisariat Anda!">
                <option value="">Pilih role</option>
                <?php foreach ($role->getResult() as $key => $row) : ?>
                    <option value="<?= $row->id; ?>"><?= $row->id; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="password">Password</label>
            <input required name="password" type="password" class="form-control" id="password" placeholder="Kata sandi">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="passwordR">Konfirmasi Password</label>
            <input required name="passwordR" type="password" class="form-control" id="passwordR" placeholder="Ulangi kata sandi">
        </div>
    </div>

    <div class="col">
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        <!-- <button class="btn btn-primary float-end">Submit</button> -->
    </div>
</div>
<?= form_close(); ?>
<!-- end -->
<div class="card-footer mt-2 border-0">
    <div class="text-center">
        <a class="small" href="" onclick="alert('Hubungi Sdr Tijani Fattah');">Lupa Sandi?</a>
    </div>
    <div class="text-center">
        <a class="small" href="<?= base_url('auth/login'); ?>">Sudah punya akun? Login!</a>
    </div>
</div>
<?= $this->endSection() ?>