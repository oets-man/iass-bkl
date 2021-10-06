<?php

use PhpParser\Node\Stmt\Foreach_;

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
                <h5 class="m-0 text-primary">Daftar RANTING<br>Komisariat <?= strtoupper($komisariat); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <?php echo form_open('komisariat/insertRanting', ['class' => 'formInsertRanting']);
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ranting</th>
                            <th class="text-center">
                                <div class="btn btn-danger btn-sm disabled">
                                    <i class="fas fa-fw fa-exclamation"></i>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ranting as $key => $r) : ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td><?= $r->ranting; ?></td>
                                <th class="text-center">
                                    <meta name="csrf-token" content="<?= csrf_hash(); ?>">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="del('<?= $r->id; ?>')">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tbody class="form-add" style="display: none;">
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-right pb-0">
                                <button type="button" class="btn btn-danger btn-sm mr-2" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-success btn-sm btn-add mr-2">Tambah</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-ins">Simpan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('.btn-add').click(function(e) {
            var komisariat = "<?= $komisariat; ?>";
            e.preventDefault();
            $('.form-add').show();
            $('.form-add').append(`
                <tr>
                    <td>
                        <input type="hidden" name="komisariat[]" class="form-control-plaintext" value="` + komisariat + `" readonly>
                    </td>
                    <td id>
                        <input type="text" name="ranting[]" class="form-control" placeholder="Masukkan ranting baru, lalu klik simpan!">
                    </td>
                    <td class="text-danger text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-del"><i class="fa fa-fw fa-minus"></i></button>
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
                        // location.reload();
                        $('#modalRanting').modal('hide');
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

    function del(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                // 'X-CSRF-TOKEN': $('input[name="csrf_test_name"]').val()
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "<?= site_url('komisariat/delRanting'); ?>",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert("Gagal dihapus");
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        });
    }
</script>

<?php
echo $this->endSection();
?>