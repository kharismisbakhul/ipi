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
                <div class="card-header <?= $background ?>">
                    <div class="text-sm font-weight-bold text-capitalize mb-1 text-center">
                        Tabel : <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="table-responsive header-table-root">
                                <table class="table table-bordered table-striped text-center tClip">
                                    <thead class=" bg-midnight-blue">
                                        <tr style="" class="header-table">
                                        </tr>
                                        <tr style="" class="tahun-dimensi">
                                        </tr>
                                    </thead>
                                    <tbody class="iniData">
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