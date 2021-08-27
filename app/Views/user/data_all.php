<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>




<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">
            <table class="table table-bordered" id="tabelUser" width="100%" cellspacing="0">
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