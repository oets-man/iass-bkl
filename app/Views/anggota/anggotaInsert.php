<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php
helper('form');
echo form_open('anggota/insert'); ?>


<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary my-1">Tambah Data Anggota</h3>
    </div>
    <div class="card-body">

        <div class="row row-cols-1 row-cols-md-3">

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Idendtitas Diri</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm">
                                <input required name="nama" type="text" class="form-control" id="nama" value="<?= old('nama'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No ID IASS</label>
                            <div class="col-sm">
                                <input type="number" name="id_iass" class="form-control" value="<?= old('id_iass'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">NIK</label>
                            <div class="col-sm">
                                <input type="number" name="nik" class="form-control" value="<?= old('nik'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tempat Lahir</label>
                            <div class="col-sm">
                                <select name="tmp_lahir" class="form-control" value="<?= old('tmp_lahir'); ?>">
                                    <option value="Bangkalan">Bangkalan</option>
                                    <option value="">Pilih tempat lahir</option>
                                    <?php foreach ($kab_kota as $i) : ?>
                                        <option value="<?= $i->kabupaten; ?>"><?= $i->kabupaten; ?></option>
                                    <?php endforeach; ?>
                                    <option value="Luar Negeri">Luar Negeri</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm">
                                <input type="date" name="tgl_lahir" class="form-control" value="<?= old('tgl_lahir'); ?>">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Alamat Lengkap</h5>
                    </div>
                    <div class="card-body">

                        <!-- <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Propinsi</label>
                            <div class="col-sm">
                                <select name="" id="" class="form-control" >
                                    <option value="35">Jawa Timur</option>
                                </select>
                            </div>
                        </div> -->
                        <input type="hidden" name="id_prov" value="35">

                        <!-- <div class="form-group row">
                            <div class="col-sm">
                                <select name="id_kab" class="form-control" >
                                    <option value="3526">Kabupaten Bangkalan</option>
                                </select>
                            </div>
                        </div> -->
                        <input type="hidden" name="id_kab" value="3526">

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Kecamatan</label>
                            <div class="col-sm">
                                <select name="id_kec" class="form-control" id="id_kec" value="<?= old('id_kec'); ?>">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan as $kec) : ?>
                                        <option value="<?= $kec->id; ?>"><?= $kec->kecamatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                            <div class="col-sm">
                                <select name="desa" id="desa" class="form-control" value="<?= old('desa'); ?>">
                                    <option value="">Pilih Desa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">RT</label>
                            <div class="col-sm">
                                <input class="form-control" type="number" name="rt" id="" value="<?= old('rt'); ?>">
                            </div>
                            <div></div>
                            <label class="col-sm-2 col-form-label">RW</label>
                            <div class="col-sm">
                                <input class="form-control" type="number" name="rw" id="" value="<?= old('rw'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Dusun</label>
                            <div class="col-sm">
                                <input type="text" name="jl" class="form-control" placeholder="Dusun/Jl/Gg/dll..." value="<?= old('jl'); ?>">
                            </div>
                        </div>

                        <?php
                        $role_level = session('role_level');
                        if ($role_level == 1) : ?>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Komisariat</label>
                                <div class="col-sm">
                                    <select required name="komisariat" class="form-control" value="<?= old('komisariat'); ?>">
                                        <option value="">Pilih Komisariat</option>
                                        <?php foreach ($komisariat as $kom) : ?>
                                            <option value="<?= $kom->komisariat; ?>"><?= $kom->komisariat; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php else :
                            $komisariat = session('komisariat'); ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Komisariat</label>
                                <div class="col-sm">
                                    <input type="text" readonly name="komisariat" class="form-control" value="<?= $komisariat; ?>">
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Data PPS</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No ID PPS</label>
                            <div class="col-sm">
                                <input type="number" name="pps_id" class="form-control" value="<?= old('pps_id'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm">
                                <input type="date" name="pps_masuk" class="form-control" value="<?= old('pps_masuk'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Keluar</label>
                            <div class="col-sm">
                                <input type="date" name="pps_keluar" class="form-control" value="<?= old('pps_keluar'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenjang Terakhir</label>
                            <div class="col-sm">
                                <select name="pps_tingkat" class="form-control" value="<?= old('pps_tingkat'); ?>">
                                    <option value="<?= null; ?>">Pendidikan Akhir PPS</option>
                                    <?php foreach ($pps_tingkat as $r) : ?>
                                        <option value="<?= $r->tingkat; ?>"><?= $r->tingkat; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kelas Terakhir</label>
                            <div class="col-sm">
                                <select name="pps_kelas" class="form-control" value="<?= old('pps_kelas'); ?>">
                                    <option value="<?= null; ?>">Kelas Akhir PPS</option>
                                    <?php foreach ($pps_kelas as $r) : ?>
                                        <option value="<?= $r->kelas; ?>"><?= $r->kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- star card -->
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Lain-Lain</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm">
                                <input type="number" name="telp" class="form-control" value="<?= old('telp'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Alamat Email</label>
                            <div class="col-sm">
                                <input type="email" name="email" class="form-control" value="<?= old('email'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Pendidikan Formal</label>
                            <div class="col-sm">
                                <select name="formal_tingkat" class="form-control" value="<?= old('formal_tingkat'); ?>">
                                    <option value="<?= null; ?>">Pilih Pendidikan Formal</option>
                                    <?php foreach ($formal_tingkat as $r) : ?>
                                        <option value="<?= $r->tingkat; ?>"><?= $r->tingkat; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Foto</label>
                            <div class="col-sm">
                                <input disabled type="password" class="form-control" id="nama" placeholder="fitur ini dalam pengembangan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- star card -->
            <!-- <div class="col mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary my-0">Lapor</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="text-area">Teks Laporan</label>
                            <textarea disabled class="form-control" id="text-area" rows="3"></textarea>
                        </div>
                        <div class="form-group form-check">
                            <input disabled type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- end card -->
        </div>
    </div>
    <div class="card-footer" align="right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Gagal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </div>
</div>

<?= form_close(); ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('#id_kec').change(function() {
            var kec_id = $(this).val();
            // console.log(kec_id);
            if (kec_id != '') {
                $.ajax({
                    url: "<?= base_url('anggota/getAlamat') ?>",
                    method: 'POST',
                    data: {
                        kec_id: kec_id,
                        aksi: 'getDesa'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">Pilih Desa</option>';
                        for (var count = 0; count < data.length; count++) {
                            // html += '<option value="' + data[count].id + '">' + data[count].desa + '</option>';
                            html += '<option value="' + data[count].desa + '">' + data[count].desa + '</option>';
                        }
                        $('#desa').html(html);
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }
                });
            } else {
                $('#desa').val('');
            }
        });
    });
</script>

<?= $this->endSection(); ?>