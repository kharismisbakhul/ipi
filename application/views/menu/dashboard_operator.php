<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h2 mb-0 text-gray-800"><?= $title; ?></h1>
        <div class="tanggal">
            <div class="text-s mb-0 font-weight-bold text-gray-400">
                <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- //Updated -->
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="d-none d-lg-block col-md-12 mb-4 box2">
            <div class="card shadow py-0">
                <div class="card-body dash">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-auto ">
                            <div class="h5 mb-0 font-weight-normal text-white">Hai <span id="user_name" class="text-white font-weight-bold text-capitalize"><?= $username ?></span>, Selamat datang di IPI - Apps</div>
                            <div class="text-s font-weight-normal text-gray-800 mt-2"></div>
                            <small>Untuk mendapatkan pengalaman yang lebih dalam menggunakan Ipi Apps <br>diharapakan menggunakan browser mozilla firefox, google chrome atau opera</small>
                        </div>
                        <div class="col-auto mr-3">
                            <img src="<?= base_url('assets/img/ad.png') ?>" style="width: 80px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4 box">
            <div class="card shadow h-100">
                <div class="card-header bg-midnight-blue text-white">
                    <div class="text-sm font-weight-bold text-capitalize">
                        Grafik : Re-scale <?= $title2; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 mr-2 rescale-chart">
                        <div class="text-gray-800 mt-1 mb-2">
                            <form action="<?= base_url('operator') ?>" method="get">
                                <div class="form-row filter-tahun">
                                    <div class="form-group col-md-2">
                                        <label for="dariTahun" class="text-xs">Dari Tahun</label>

                                        <select class="custom-select" name="star_date" id="start-date">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="sampaiTahun" class="text-xs">Sampai Tahun</label>
                                        <select class="custom-select" name="end_date" id="end-date">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-2" style="padding-top: 1.9rem;">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary" id="Search-Button">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body chart">
                        <canvas id="chart-dimensi" style="width: 100%; height: 30rem;"></canvas>
                    </div>
                    <div class="col-md-12 mr-2">
                        <div class="text-gray-800 mt-0">
                            <div class="legenda card no-border" style="width: auto;">
                                <div class="card-body">
                                    <?php $subdimensi = $this->db->get_where('subdimensi', ['kode_d' => $this->session->userdata('status_user')])->result_array(); ?>
                                    <?php foreach ($subdimensi as $sd) : ?>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <a href="#" id="subdimensi<?= $sd['kode_sd']; ?>" role="button" class="btn square-legend bg-cream"></a>
                                        </div>
                                        <div class="col-xs-6">
                                            <small>
                                                <a href="<?= base_url('admin/subdimensi?sd=') . $sd['kode_sd']; ?>" class="text-sm text-decoration-none text-secondary ml-4"><?= $sd['nama_sub_dimensi'] ?></a>
                                            </small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 box2">
            <div class="card shadow h-100">
                <div class="card-header bg-midnight-blue text-white">
                    <div class="text-sm font-weight-bold text-capitalize mb-1">
                        Table Data re-scale <?= $title2; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center tClip">
                                    <thead class="header-table-root">
                                        <tr style="background-color:#2c3e50;color: #ffffff" class="header-table">
                                        </tr>
                                        <tr style="background-color:#2c3e50; color: #ffffff" class="tahun-dimensi">
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

</div>
</div>