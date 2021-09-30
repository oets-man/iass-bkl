<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php
// d($anggota); 
?>

<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary my-1"><?= $title; ?></h3>
        <a href="" class="btn btn-warning"">Edit</a>
        <a href="" class=" btn btn-danger"">Hapus</a>
    </div>
    <div class=" card-body">
        <div class="row row-cols-1 row-cols-md-3">
            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Idendtitas Diri</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nama Lengkap</td>
                                <td><?= $anggota->nama; ?></td>
                            </tr>
                            <tr>
                                <td>ID IASS</td>
                                <td><?= $anggota->id_iass; ?></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td><?= $anggota->nik; ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td><?= $anggota->tmp_lahir; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td><?= $anggota->tgl_lahir; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Alamat Lengkap</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Alamat</td>
                                <td><?= $anggota->alamat1; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= $anggota->alamat2; ?></td>
                            </tr>
                            <tr>
                                <td>Komisariat</td>
                                <td><?= $anggota->komisariat; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Data PPS</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>ID PPS</td>
                                <td><?= $anggota->pps_id; ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Masuk</td>
                                <td><?= $anggota->pps_masuk; ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Keluar</td>
                                <td><?= $anggota->pps_keluar; ?></td>
                            </tr>
                            <tr>
                                <td>Kelas Terakhir</td>
                                <td><?= $anggota->pps_akhir_kelas; ?></td>
                            </tr>
                            <tr>
                                <td>Jenjang Terakhir</td>
                                <td><?= $anggota->pps_akhir_tingkat; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Lain-Lain</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nomor Telepon</td>
                                <td><?= $anggota->telp; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Email</td>
                                <td><?= $anggota->email; ?></td>
                            </tr>
                            <tr>
                                <td>Pendidikan Formal</td>
                                <td><?= $anggota->formal_tingkat; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->

        </div>
    </div>
</div>


<?= $this->endSection(); ?>