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
        $("#modalStatus").modal('show');
    });
</script>

<div class="modal fade" data-bs-backdrop="static" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-0 text-primary">Riwayat STATUS<br><span style="font-variant: small-caps;"><?= $anggota->nama; ?></span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('modal/insertStatus', ['class' => 'formInsertStatus']);
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th class="text-center">
                                <div class="btn btn-danger btn-sm disabled">
                                    <i class="fas fa-fw fa-exclamation"></i>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($status as $key => $r) : ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td><?= $r->status; ?></td>
                                <th class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="del('<?= $r->id; ?>')">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                        <!-- </tbody>
                    <tbody class="form-add" style="display: none;"> -->
                        <tr>
                            <td>
                                <input type="hidden" name="id_anggota" class="form-control-plaintext" value="<?= $anggota->id; ?>" readonly>
                            </td>
                            <td>
                                <!-- <input type="text" name="status" class="form-control" placeholder="Masukkan status, lalu klik simpan!"> -->
                                <select name="id_status" class="form-select" id="status">
                                    <option value="">Pilih Status</option>
                                    <?php foreach ($list_status as $r) : ?>
                                        <option value="<?= $r->id; ?>"><?= $r->status; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="text-danger text-center">
                                <button type="button" class="btn btn-danger btn-sm btn-del" disabled><i class="fa fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <div class="float-end">
                    <button type="button" class="btn btn-danger btn-sm me-2" data-bs-dismiss="modal">Tutup</button>
                    <!-- <button type="button" class="btn btn-success btn-sm btn-add me-2">Tambah</button> -->
                    <button type="submit" disabled class="btn btn-primary btn-sm btn-ins">Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('#status').change(function(e) {
            e.preventDefault();
            var id = $(this).val();
            if (id != '') {
                $('.btn-ins').attr('disabled', false);
            } else {
                $('.btn-ins').attr('disabled', true);
            }
        });


        //simpan/insert
        $('.formInsertStatus').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                        $('#modalStatus').modal('hide');
                    } else {
                        alert("Tidak ada data yang ditambahkan!");
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            });
            return false;
        });

    });

    // $(document).on('click', '.btn-del', function(e) {
    //     $(this).parents('tr').remove();
    // });

    $('#modalStatus').on('hidden.bs.modal', function() {
        // window.alert('hidden event fired!');
        parent.history.back();
        return false;
    });

    function del(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "<?= site_url('modal/delStatus'); ?>",
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