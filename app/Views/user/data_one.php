<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>




<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4 mx-auto" style="max-width: 720px; min-width: 300px;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?= base_url('assets'); ?>/img/default.jpg" alt="" class="img-thumbnail" style="margin: 1.25rem; max-width: 250px; min-width: 150px;">
        </div>
        <div class="col-md-8">
            <div class="card-body" style="margin: .75rem;">
                <h5 class="card-title mb-0" style="margin-left: .75rem;;"><?= $users->getRow()->nama; ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Email</td>
                            <td><?= $users->getRow()->email; ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td><?= $users->getRow()->role_id; ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td><?= $users->getRow()->jabatan; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if ($users->getRow()->active == 1) {
                                    $cek = "checked";
                                    $tombol = "Nonaktifkan";
                                    $btnClass = "btn btn-sm btn-danger";
                                } else {
                                    $cek = "";
                                    $tombol = "Aktifkan";
                                    $btnClass = "btn btn-sm btn-success";
                                }; ?>
                                <div class="form-check">
                                    <input disabled class="form-check-input" type="checkbox" value="" id="" <?= $cek; ?>>
                                    <label class="form-check-label" for="">
                                        Aktif
                                    </label>
                                </div>
                            </td>
                            <td><a href="<?= base_url(); ?>/user/activate/<?= $users->getRow()->email; ?>" class="<?= $btnClass; ?>"><?= $tombol; ?></a> </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>