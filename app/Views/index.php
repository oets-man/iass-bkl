<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Content Row -->
<div class="row">
    <?php
    foreach ($komisariat as $kom) : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-2"><?= $kom->komisariat; ?>
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
                                // var_dump($result);
                                // die;
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
                                            <td><?= $row->count; ?></td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= $jumlah; ?></td>
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
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>