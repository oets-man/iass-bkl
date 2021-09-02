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
                        <th>#</th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Komisariat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ambil dari data tabel server side -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
if (isset($komisariat)) {
    $url_komisariat = "/" . $komisariat;
} else {
    $url_komisariat = null;
};
echo $url_komisariat;
?>

<!-- modal tambah data -->
<?= view_cell('\App\Controllers\Anggota::AnggotaInsert'); ?>


<script>
    function listDataAnggota() {
        var table = $('#tabel-anggota').DataTable({
            'processing': true,
            'serverSide': true,
            'order': [
                // [4, 'asc'],
                // [5, 'asc']
            ],
            'ajax': {
                'url': "<?= base_url('anggota/listdata') . $url_komisariat ?>",
                'type': "POST",
                'data': {
                    'komisariat': "<?= $url_komisariat ?>"
                },
            },
            'columnDefs': [{
                'targets': [0, 1],
                'orderable': false,
                'className': 'text-center'
            }],
        })
    }

    $(document).ready(function() {
        listDataAnggota();
    });
</script>

<?= $this->endSection(); ?>