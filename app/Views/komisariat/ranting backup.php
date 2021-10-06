<?php
echo $this->extend('layout/template');
?>
<?php
echo $this->section('content');
?>


<!-- Modal -->
<script>
    $(document).ready(function() {
        $("#modalRanting").modal('show');
    });
</script>

<div class="modal fade" data-backdrop="static" id="modalRanting" tabindex="-1" role="dialog" aria-labelledby="modalRantingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>List Ranting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header form-group row my-0">
                <label for="komisariat" class="col-sm-3 col-form-label text-primary font-weight-bold">Komisariat:</label>
                <div class="col-sm-9">
                    <select class="form-control" id="komisariat">
                        <option value="">Pilih Komisariat ...</option>
                        <?php
                        foreach ($komisariat as $key => $value) : ?>
                            <option value="<?= $value->id; ?>"><?= $value->id; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="modal-body">
                <?= form_open('komisariat/insertRanting', ['class' => 'formInsertRanting']); ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ranting</th>
                            <th class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody id="listranting">
                        <tr>
                            <td></td>
                            <td class="text-info">Silakan tentukan komisariat...</td>
                            <td></td>
                        </tr>
                    </tbody>

                    <tbody class="form-add" style="display: none;">
                    </tbody>
                    <tbody class="" style="display: none;">
                        <tr>
                            <td colspan="3" class="text-right">
                                <button type="button" class="btn btn-danger btn-sm btn-add mr-2" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-success btn-sm btn-add mr-2">Tambah</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-ins">Simpan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#komisariat').change(function() {
            var komisariat = $(this).val();
            if (komisariat != '') {
                $('tbody').show();

                $.ajax({
                    url: "<?= base_url('komisariat/getRanting') ?>",
                    method: 'POST',
                    data: {
                        komisariat: komisariat,
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.length > 0) {
                            var html = '';
                            var i = 1;
                            data.forEach(data => {
                                // console.log(data.ranting);
                                html += `
                                <tr>
                                    <td>` + i++ + `</td>
                                    <td>` + data.ranting + `</td>
                                    <td class='text-center'>
                                        <a class="text-danger" href="<?= site_url('komisariat/rantingdelete/'); ?>` + data.id + `"><i class="fas fa-trash"></a></i>
                                    </td>
                                </tr>`
                            });
                        } else {
                            var html = `
                                <tr>
                                    <td></td>
                                    <td>Belum ada data. Silakan klik tambah!</td>
                                    <td></td>
                                </tr>`;
                        }
                        $('#listranting').html(html);
                        // console.log(data);
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }
                });
            } else {
                $('tbody').hide();
            }
        });
    });

    $(document).ready(function(e) {
        $('.btn-add').click(function(e) {
            var komisariat = $('#komisariat').val();
            e.preventDefault();
            $('.form-add').append(`
                <tr>
                    <td id="">
                        <input type="text" name="komisariat[]" class="form-control-plaintext" value="` + komisariat + `" readonly>
                    </td>
                    <td id="">
                        <input type="text" name="ranting[]" class="form-control" placeholder="Masukkan ranting baru, lalu klik simpan!">
                    </td>
                    <td class="text-danger text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-del"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
            `)
        });

        //simpan/insert
        $('.formInsertRanting').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",

                beforeSend: function() {
                    $('.btn-ins').attr('disable', 'disabled');
                    $('.btn-ins').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-ins').removeAttr('disable');
                    $('.btn-ins').html('Simpan');
                },
                success: function(response) {
                    if (response == true) {
                        alert("Data berhasil ditambahkan!");
                        // window.location.href = "<?= site_url('komisariat/ranting') ?>";
                        location.reload();
                    } else {
                        alert("Tidak ada data yang ditambahkan!");
                    }
                },
                // error: function(xhr, thrownError) {
                //     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                // }
            });
            return false;
        });

    });

    $(document).on('click', '.btn-del', function(e) {
        $(this).parents('tr').remove();
    });

    $('#modalRanting').on('hidden.bs.modal', function() {
        // window.alert('hidden event fired!');
        parent.history.back();
        return false;
    });
</script>

<?php
echo $this->endSection();
?>