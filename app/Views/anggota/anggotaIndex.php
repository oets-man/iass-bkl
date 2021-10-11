<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->

<?php
$data = $_SERVER['PATH_INFO'];
$getKomisariat = stripos($data, "komisariat/")  ? true : false;
$urlKomisariat = substr($data, stripos($data, "komisariat/") + 11);
$sessData = [
    'getKomisariat' => $getKomisariat,
    'urlKomisariat' => $urlKomisariat,
];
session()->set($sessData);
?>

<!-- DataTales Example -->

<div class="card-header py-2 px-4 mb-4">
    <h3 class="text-primary subjudul">Daftar Anggota
        <?php
        if ($getKomisariat) : ?>
            Komisariat <?= strtoupper($urlKomisariat); ?>
            <span class="float-end">
                <a href="<?= base_url('anggota/insert'); ?>" type="button" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-square me-2"></i>Tambah
                </a>
            </span>
        <?php else : ?>
            IASS Wilayah BANGKALAN
        <?php endif; ?>
    </h3>
</div>
<div class="card-body">
    <!-- <div class="table-responsive table-hover"> -->

    <table class="table table-bordered" id="tabel-anggota" width="100%" cellspacing="0">
        <!-- <table id="tabel-anggota" class="table table-striped"> -->
        <thead>
            <tr>
                <th>Detail</th>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Komisariat</th>
                <th>Ranting</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- ambil dari data tabel server side -->
        </tbody>
    </table>
    <!-- </div> -->
</div>


<!-- modal tambah data -->
<?php
// echo view_cell('\App\Controllers\Anggota::insert'); 
?>

<script>
    function listDataAnggota() {
        var token = "<?= csrf_hash() ?>";
        var table = $('#tabel-anggota').DataTable({
            'processing': true,
            'serverSide': true,
            'order': [],
            'ajax': {
                'url': "<?= base_url('anggota/listdata') ?>",
                'type': "POST",
                'data': function(d) {
                    d.<?= csrf_token() ?> = token;
                },
            },
            //optional
            // "lengthMenu": [
            //     [5, 10, 25],
            //     [5, 10, 25]
            // ],
            'columnDefs': [{
                'targets': [0, 1],
                'orderable': false,
                'className': 'text-center'
            }],
        });

        table.on('xhr.dt', function(e, settings, json, xhr) {
            token = json.<?= csrf_token() ?>;
        });
    }

    $(document).ready(function() {
        listDataAnggota();
    });
</script>

<?= $this->endSection(); ?>