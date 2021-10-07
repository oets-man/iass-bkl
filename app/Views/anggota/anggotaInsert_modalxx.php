<!-- Modal -->

<?php
helper('form');
echo form_open('anggota/insert'); ?>
<div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="modalTambahLabel">Tambah Data Anggota</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h4 class="text-success">Data Diri</h4>
                <div class="form-group row">
                    <div class="col-sm">
                        <!-- <small class="">Nama Lengkap</small> -->
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
                    </div>
                </div>

                <div class="form-group row">
                    <!-- <small class="">Masukkan Alamat Lengkap</small> -->
                    <div class="col-sm">
                        <input type="number" name="id_iass" class="form-control" placeholder="No ID IASS" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <!-- <label for="id_iass" class="col-sm-4 col-form-label">ID IASS</label> -->
                    <div class="col-sm">
                        <input type="number" name="nik" class="form-control" placeholder="NIK (Nomor Induk Kependudukan)">
                    </div>
                </div>

                <div class="form-group row">
                    <!-- <label for="id_iass" class="col-sm-4 col-form-label">ID IASS</label> -->
                    <div class="col-sm">
                        <select name="tmp_lahir" class="form-control">
                            <option value="">Pilih tempat lahir</option>
                            <option value="Bangkalan">Bangkalan</option>
                            <?php foreach ($kab_kota as $i) : ?>
                                <option value="<?= $i->kabupaten; ?>"><?= $i->kabupaten; ?></option>
                            <?php endforeach; ?>
                            <option value="Luar Negeri">Luar Negeri</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <select name="id_prov" class="form-control">
                            <option value="35">Jawa Timur</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <select name="id_kab" class="form-control">
                            <option value="3526">Kabupaten Bangkalan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <select name="id_kec" class="form-control" id="kec_id">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <option value="<?= $kec->id; ?>"><?= $kec->kecamatan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <select name="desa" id="desa" class="form-control">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm" style="display: flex;">
                        <label for="rt" class="col-form-label" style="padding-right: 20px;">RT
                        </label>
                        <input class="form-control" type="number" name="rt" id="" value="1">
                    </div>
                    <div class="form-group col-sm" style="display: flex;">
                        <label for="rw" class="col-form-label" style="padding-right: 20px;">RW
                        </label>
                        <input class="form-control" type="number" name="rw" id="" value="1">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm">
                        <input type="text" name="jl" class="form-control" placeholder="Jl/Gg/Dusun/Kampung/dll...">
                    </div>
                </div>

                <?php
                $role_level = session('role_level');
                if ($role_level == 1) : ?>
                    <div class="form-group row">
                        <div class="col-sm">
                            <select name="komisariat" class="form-control">
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
                        <label for="komisariat" class="col-sm-3 col-form-label">Komisariat</label>
                        <div class="col-sm">
                            <input type="text" readonly class="form-control" id="komisariat" value="<?= $komisariat; ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <div class="col-sm">
                        <input type="number" name="telp" class="form-control" placeholder="Nomor telepon">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm">
                        <input type="email" name="email" class="form-control" placeholder="Alamat email">
                    </div>
                </div>

                <h4 class="text-success">Data PPS</h4>
                <div class="form-group row">
                    <div class="col-sm">
                        <input type="number" name="pps_id" class="form-control" placeholder="No ID PPS">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm" style="display: flex;">
                        <label for="pps_masuk" class="col-form-label" style="padding-right: 20px;">Masuk
                        </label>
                        <input class="form-control" type="date" name="pps_masuk" style="max-width: 150px;">
                    </div>
                    <div class="form-group col-sm" style="display: flex;">
                        <label for="pps_keluar" class="col-form-label" style="padding-right: 20px;">Keluar
                        </label>
                        <input class="form-control" type="date" name="pps_keluar" style="max-width: 150px;">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm" style="display: flex;">
                        <select name="pps_tingkat" class="form-control">
                            <option value="<?= null; ?>">Pendidikan Akhir PPS</option>
                            <?php foreach ($pps_tingkat as $r) : ?>
                                <option value="<?= $r->tingkat; ?>"><?= $r->tingkat; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm" style="display: flex;">
                        <select name="pps_kelas" class="form-control">
                            <option value="<?= null; ?>">Kelas Akhir PPS</option>
                            <?php foreach ($pps_kelas as $r) : ?>
                                <option value="<?= $r->kelas; ?>"><?= $r->kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <h4 class="text-success">Data Formal</h4>
                <div class="form-group row">
                    <div class="col-sm">
                        <select name="formal_tingkat" class="form-control">
                            <option value="<?= null; ?>">Pendidikan Formal</option>
                            <?php foreach ($formal_tingkat as $r) : ?>
                                <option value="<?= $r->tingkat; ?>"><?= $r->tingkat; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Gagal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>

        </div>
    </div>
</div>
<?= form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kec_id').change(function() {
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