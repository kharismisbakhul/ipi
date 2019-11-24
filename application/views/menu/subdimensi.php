<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2">
        <div class="col-sm-0">
            <i class="fas fa-fw fa-chart-bar fo"></i>
        </div>
        <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 box2">
            <div class="card shadow h-100">
                <div class="card-header <?= $background ?> text-white">
                    <div class="text-sm font-weight-bold text-capitalize mb-1 text-center">
                        Grafik : <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body mb-2">
                    <div class="row align-items-center" style="height: 500px;">
                        <div class="col-lg-12">
                            <div class="card-body chart mb-2">
                                <canvas id="chart-subdimensi" style="width: 100%; height: 30rem;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 box2">
            <div class="card shadow h-100">
                <div class="card-header <?= $background ?> text-white">
                    <div class="text-sm font-weight-bold text-capitalize mb-1 text-center">
                        Tabel : <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="table-responsive header-table-root">
                                <table class="table table-bordered table-striped text-center tClip table-sm flex-wrap">
                                    <thead class=" bg-midnight-blue">
                                        <tr style="color: #ffffff" class="header-table">
                                        </tr>
                                        <tr style="color: #ffffff" class="tahun-sub">
                                        </tr>
                                    </thead>
                                    <tbody class="iniData-subdimensi">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->