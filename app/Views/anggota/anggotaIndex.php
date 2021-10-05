<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">

        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah
        </button> -->
        <a href="<?= base_url('anggota/insert'); ?>" type="button" class="btn btn-primary">
            Tambah
        </a>

    </div>
    <div class="card-body">
        <div class="table-responsive table-hover">

            <table class="table table-bordered" id="tabel-anggota" width="100%" cellspacing="0">
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
        </div>
    </div>
</div>

<!-- modal tambah data -->
<?php
// echo view_cell('\App\Controllers\Anggota::insert'); 
?>

<?php
$data = $_SERVER['PATH_INFO'];
$getKomisariat = stripos($data, "komisariat/")  ? true : false;
$urlKomisariat = substr($data, stripos($data, "komisariat/") + 11);
// $level = session('role_level');
// var_dump(stripos($data, "komisariat/"));
// var_dump($url_komisariat);
// var_dump($is_komisariat);
// var_dump($level);

$sessData = [
    'getKomisariat'    => $getKomisariat,
    'urlKomisariat'    => $urlKomisariat,
];
session()->set($sessData);

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