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


    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>


    <div class="row mt-4 mb-4">
        <?php $dimensi = $this->db->get('dimensi')->result_array(); ?>
        <div class="col-lg-12 box">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 flex-row align-items-center justify-content-between bg-midnight-blue text-white text-capitalize text-center">
                    <h6 class="m-0 font-weight-bold">Grafik : Indeks Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="table-responsive">
                    <div class="card-body chart">
                        <canvas id="ipi-chart" style="width: 100%; height: 30rem;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 box2 mt-4">
            <div class="card shadow box2">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 flex-row bg-midnight-blue text-white text-capitalize  ">
                    <h6 class="m-0 font-weight-bold text-center">Tabel : Indeks Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="table-responsive header-table-root">
                        <table class="table table-bordered table-striped text-center tClip">
                            <thead class=" bg-midnight-blue">
                                <tr style=" color: #FFFFFF" class="header-table">
                                </tr>
                                <tr style=" color: #FFFFFF" class="tahun-ipi">
                                </tr>
                            </thead>
                            <tbody class="iniDataIpi">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Area Rentan Wakti -->

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->