<style type="text/css">
    table thead tr th {
        background-color: #485460;
        color: #ecf0f1;
    }

    table thead tr th,
    table tbody tr td {
        font-family: 'Calibri', sans-serif;
        color: black;
        font-size: 14px;
        border: 1px solid black;
        text-align: center;
    }

    table thead tr th {
        color: white;
    }

    #ipi td {
        background-color: yellow;
        text-align: center;
        color: black;
    }

    #dimensiD td {
        background-color: #3498db;
        color: white;
    }

    #sub-dimensiSD td {
        background-color: #fa8231;
        color: black;
    }

    #status1 {
        background-color: #e74c3c;
        color: white;
    }

    #status2 {
        background-color: #f9ca24;
        color: black;
    }
</style>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2">
        <div class="col-sm-0">
            <i class="fas fa-fw fa-file-alt"></i>
        </div>
        <div class="col-sm-6">
            <h1 class="h3 text-gray-800"><?= $title; ?> Data</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-center">
                        <?= $title;  ?> : Indeks Pembangunan Inklusif - Data Indikator Sosial Ekonomi
                    </div>
                </div>
                <div class="card-body global">
                    <div class="row">
                        <div class="col-md-12 data-report">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 510px">
                                    <table class="table table-bordered table-borde table-report table-global text-nowrap">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                                                <th class="align-middle" rowspan="2">Dimensi</th>
                                                <th colspan="<?= $col_span ?>" class="align-middle">Data Indikator Sosial Ekonomi</th>
                                            </tr>
                                            <tr>
                                                <!-- Tahun Re-Scale Indikator (SCORE) -->
                                                <?php foreach ($range_tahun as $rt) : ?>
                                                    <th scope="col"><?= $rt['tahun'] ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #101010">
                                            <!-- IPI Column -->
                                            <tr id="ipi">
                                                <td colspan="4">Indeks Pembangunan Inklusif</td>
                                                <?php foreach ($range_tahun as $rt) : ?>
                                                    <td scope="col"></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <!-- IPI Column End -->

                                            <?php for ($d = 0; $d < $jumlahData['jumlah_d']; $d++) { ?>
                                                <!-- Dimensi -->
                                                <tr class="dimensiD" id="dimensiD">
                                                    <td><?= ($d + 1); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-left"><?= $dimensi[$d]['nama_dimensi'] ?></td>
                                                    <?php foreach ($range_tahun as $rt) : ?>
                                                        <td scope="col"></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                                <?php $jumlahSubDimensi = $jumlahData['detail'][$d]['subDimensi']['jumlah_sd'];
                                                    for ($sd = 0; $sd < $jumlahSubDimensi; $sd++) { ?>
                                                    <!-- Sub Dimensi -->
                                                    <tr class="sub-dimensiSD" id="sub-dimensiSD">
                                                        <td></td>
                                                        <td><?= ($sd + 1); ?></td>
                                                        <td></td>
                                                        <td class="text-left"><?= $dimensi[$d]['subDimensi'][$sd]['nama_sub_dimensi'] ?></td>
                                                        <?php foreach ($range_tahun as $rt) : ?>
                                                            <td scope="col"></td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                    <?php $jumlahIndikator = $jumlahData['detail'][$d]['subDimensi']['detail'][$sd]['indikator']['jumlah_indikator']; ?>
                                                    <?php for ($ind = 0; $ind < $jumlahIndikator; $ind++) { ?>
                                                        <!-- Indikator -->
                                                        <tr>
                                                            <?php $id = "";
                                                                        $indikator = $dimensi[$d]['subDimensi'][$sd]['indikator'];
                                                                        if ($indikator[$ind]['status'] == 1) {
                                                                            $id = "status1";
                                                                        } elseif ($indikator[$ind]['status'] == 2) {
                                                                            $id = "status2";
                                                                        }
                                                                        ?>
                                                            <td class=""></td>
                                                            <td class=""></td>
                                                            <td class="" id="<?= $id ?>"><?= $ind + 1; ?></td>
                                                            <td class="text-left" id="<?= $id ?>"><?= $indikator[$ind]['nama_indikator'] ?></td>
                                                            <?php foreach ($indikator[$ind]['nilai_eksisting'] as $ine) : ?>
                                                                <td class=""><?= $ine ?></td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- End Data -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->