<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="card-header py-3">
    <h3 class="text-primary subjudul">Data Anggota IASS Wilayah Bangkalan
</div>
<div class="card-body">


    <!-- Content Row -->
    <div class="row">
        <?php
        foreach ($komisariat as $kom) : ?>
            <div class="col-xl-3 col-md-6">
                <div class="card shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-primary mb-2" style="font-variant: small-caps;"><?= $kom->komisariat; ?>
                                </div>
                                <table class="table">
                                    <?php
                                    $komis = $kom->komisariat;
                                    $db = \Config\Database::connect();
                                    $str = "SELECT a.komisariat, a.status as status, Count(a.id) AS count
                                                FROM anggota_view as a
                                                GROUP BY a.komisariat, a.status
                                                HAVING (((a.komisariat)='$komis')) 
                                                ORDER BY a.id_status ASC";
                                    $result = $db->query($str)->getResult();
                                    ?>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $jumlah = 0;
                                        foreach ($result as $row) :
                                            $total = $row->count;
                                            $jumlah += $total; ?>
                                            <tr>
                                                <td>- <?= $row->status; ?></td>
                                                <td class="text-end"><?= $row->count; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="fst-italic">Total</td>
                                            <td class="text-end fw-bold"><?= $jumlah; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                            </div>
                            <!-- <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>

        <!--START TOTAL -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-primary mb-2" style="font-variant: small-caps;">Total
                            </div>
                            <table class="table">
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $jumlah = 0;
                                    foreach ($komisariatCount as $k) :
                                        $total = $k->subTotal;
                                        $jumlah += $total; ?>
                                        <tr>
                                            <td>- <?= $k->status; ?></td>
                                            <td class="text-end"><?= $k->subTotal; ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td class="fst-italic">Gand Total</td>
                                        <td class="text-end fw-bold"><?= $jumlah; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END TOTAL -->


</div>



<?= $this->endSection() ?>