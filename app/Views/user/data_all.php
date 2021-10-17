<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->

<!-- DataTales Example -->

<div class="card-header py-2 px-4 mb-4">
    <h3 class="text-primary subjudul">Data User
        <span class="float-end">
            <a href="<?= site_url('auth/registrasi'); ?>" type="button" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-square me-2"></i>Tambah
            </a>
        </span>
    </h3>
</div>
<div class="card-body">
    <table id="tabel-user" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>akun</th>
                <th>Aktif</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users->getResult() as $key => $row) : ?>
                <?php if ($row->is_active == 1) {
                    $aktif = 'Ya';
                    $class = "";
                } else {
                    $aktif = 'Tidak';
                    $class = "class='text-danger'";
                }; ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><a href="manage/<?= $row->akun; ?>"><?= $row->akun; ?></a> </td>
                    <td <?= $class; ?>><?= $aktif; ?></td>
                    <td><?= $row->role_id; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<!-- <script src="<?= base_url(); ?>/assets_voler/vendors/simple-datatables/simple-datatables.js"></script> -->
<script>
    $(document).ready(function() {
        $('#tabel-user').DataTable();
    });
</script>
<?= $this->endSection() ?>