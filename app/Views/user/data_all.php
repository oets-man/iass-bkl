<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>




<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="text-primary subjudul">Data User
            <span class="float-right">
                <a href="<?= site_url('auth/registrasi'); ?>" type="button" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-square mr-2"></i>Tambah
                </a>
            </span>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">
            <table class="table table-bordered" id="tabelUser" width="100%" cellspacing="0">
                <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aktif</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <?php foreach ($users->getResult() as $key => $row) : ?>
                    <?php if ($row->is_active == 1) {
                        $aktif = 'Ya';
                        $class = "";
                    } else {
                        $aktif = 'Tidak';
                        $class = "class='text-danger'";
                    }; ?>
                    <tbody>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><a href="manage/<?= $row->email; ?>"><?= $row->email; ?></a> </td>
                            <td <?= $class; ?>><?= $aktif; ?></td>
                            <td><?= $row->role_id; ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>