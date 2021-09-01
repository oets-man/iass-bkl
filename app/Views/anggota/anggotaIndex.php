<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah
        </button>

    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">

            <table class="table table-bordered" id="tabel-anggota" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>alamat</th>
                        <th>Komisariat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php foreach ($anggota as $key => $row) : ?>
                    <tbody>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->alamat1; ?></td>
                            <td><?= $row->komisariat; ?></td>
                            <td><?= $row->status; ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- modal tambah data -->
<?= view_cell('\App\Controllers\Anggota::AnggotaInsert'); ?>

<?= $this->endSection(); ?>