<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<!-- <link href="<?= base_url('assets'); ?>/vendor/select2/select2.min.css" rel="stylesheet" />
<script src="<?= base_url('assets'); ?>/vendor/select2/select2.min.js"></script> -->

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

            <table class="table table-bordered" id="tabelUser" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>alamat</th>
                        <th>Komisariat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php foreach ($anggota->getResult() as $key => $row) : ?>
                    <tbody>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><a href="manage/<?= $row->desa; ?>"><?= $row->desa; ?></a> </td>
                            <td><?= $row->kecamatan; ?></td>
                            <td><?= $row->kabupaten; ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<form action="anggota/insert" method="post">

    <div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="number" name="nik" class="form-control" placeholder="NIK (Nomor Induk Kependudukan)">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tmp_lahir" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <select name="prov_id" class="form-control">
                            <option value="35">Jawa Timur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kab_id" class="form-control">
                            <option value="3526">Kabupaten Bangkalan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kec_id" class="form-control" id="kec_id">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan->getResult() as $kec) : ?>
                                <option value="<?= $kec->id; ?>"><?= $kec->kecamatan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="desa" id="desa" class="form-control">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <input type="number" name="rt" class="form-control" placeholder="RT">
                        </div>
                        <div class="form-group col-6">
                            <input type="number" name="rt" class="form-control" placeholder="RW">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="jl" class="form-control" placeholder="Jl/Gg/Dusun/Kampung/dll...">
                    </div>

                    <div class="form-group">
                        <select name="kom_id" class="form-control">
                            <option value="">Pilih Komisariat</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">gagal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

            </div>
        </div>
    </div>
</form>

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


<?= $this->endSection(); ?>