<style type="text/css">
    table thead tr th {
        background-color: #485460;
        color: #ecf0f1;
        border: 1px black;
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

    <div class="row">
        <div class="col-xl-4 col-md-4 col-sm-4 mb-2">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-center">
                        Pilih Rentan Waktu
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="<?= base_url('admin/report/rescale') ?>" method="get">
                            <div class="row ml-1 mr-1">
                                <div class="col-lg-12 mb-2 text-justify">
                                    Untuk menampilkan data pada
                                    tabel dan chart, harap untuk
                                    mengisi rentan tahun di bawah
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <small>dari tahun</small>
                                    <select class="custom-select" id="start-date" name="star_date">

                                    </select>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <small>sampai tahun</small>
                                    <select class="custom-select" id="end-date" name="end_date">

                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn btn-primary submit" style="width: 100%" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-5 col-sm-5">
            <div class="card shadow h-auto" style="width: 70%">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-center">
                        Action
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?= base_url('inputData'); ?>" class="btn btn-primary btn-icon-split tambah-user pr-5 float-left">
                                <span class="icon text-white-50 float-left">
                                    <i class="fas fa-fw fa-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                        </div>
                        <div class="mt-3 col-lg export-excel">
                            <a href="<?= base_url('report/export/rescale?star_date=') . $this->input->get('star_date'); ?>&end_date=<?= $this->input->get('end_date');   ?>" class="btn btn-success btn-icon-split export-to-excel">
                                <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-file-excel"></i>
                                </span>
                                <span class="text">Download Excel File</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-center">
                        <?= $title;  ?> : Indeks Pembangunan Inklusif - Data Indeks Sosial Ekonomi
                    </div>
                </div>
                <div class="card-body global">
                    <div class="text-center report">
                        <p>Kalkulasi Data Indeks Pembangunan Inklusif...</p>
                        <div id="progressTimer"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 data-report">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 510px">
                                    <div class="loading-progress"></div>

                                    <table class="table table-bordered table-borde table-report table-global text-nowrap" id="myTable">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                                                <th class="align-middle" rowspan="2">Dimensi</th>
                                                <th colspan="<?= count($tahun) ?>" class="align-middle">Data Indeks Sosial Ekonomi</th>
                                            </tr>
                                            <tr>
                                                <!-- Tahun Re-Scale Indikator (SCORE) -->
                                                <?php foreach ($tahun as $rt) : ?>
                                                    <th scope="col"><?= $rt['tahun'] ?></th>
                                                <?php endforeach; ?>

                                            </tr>
                                        </thead>
                                        <tbody class="iniData" style="color: #101010">
                                            <tr class="ipi" id="ipi">
                                                <td colspan="4">Indeks Pembangunan Inklusif</td>
                                            </tr>
                                            <!-- dimensi -->
                                            <?php $indek1 = 1; ?>
                                            <?php foreach ($dimensi as $d) : ?>
                                                <tr class="dimensi<?= $d['kode_d'] ?>" id="dimensiD">
                                                    <td><?= $indek1++ ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-left"><?= $d['nama_dimensi'] ?></td>
                                                </tr>
                                                <!-- Subdimensi -->
                                                <?php $indek2 = 1; ?>
                                                <?php foreach ($subdimensi as $sd) : ?>
                                                    <?php if ($sd['kode_d'] == $d['kode_d']) : ?>
                                                        <tr class="subdimensi<?= $sd['kode_sd'] ?>" id="sub-dimensiSD">
                                                            <td></td>
                                                            <td><?= $indek2++; ?></td>
                                                            <td></td>
                                                            <td class="text-left"><?= $sd['nama_sub_dimensi'] ?></td>
                                                        </tr>
                                                        <!-- Indikator -->
                                                        <?php $indek3 = 1; ?>
                                                        <?php foreach ($indikator as $in) : ?>
                                                            <?php if ($in['kode_sd'] == $sd['kode_sd']) : ?>
                                                                <tr class="indikator<?= $in['kode_indikator']  ?>" id="indikatoriI">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><?= $indek3++; ?></td>
                                                                    <?php $id = "";
                                                                                        if ($in['status'] == 1) {
                                                                                            $id = "status1";
                                                                                        } elseif ($in['status'] == 2) {
                                                                                            $id = "status2";
                                                                                        } ?>
                                                                    <td id="<?= $id ?>" class="text-left"><?= $in['nama_indikator'] ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <!-- Akhir Indikator -->
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!-- akhir Subdimensi -->
                                            <?php endforeach; ?>
                                            <!-- akhir dimensi -->

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