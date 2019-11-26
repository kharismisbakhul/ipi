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
        <div class="col-lg-8">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-blue">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Indeks Pembangunan Inklusif
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?= base_url('inputData/hapusData') ?>" method="post">
                        <div class="form-group row">
                            <label for="dimensi" class="col-sm-2 col-form-label">Dimensi</label>
                            <div class="col-sm-6">
                                <select class="form-control dimensi" name="dimensi" id="dimensi">
                                </select>
                                <?= form_error('dimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subDimensi" class="col-sm-2 col-form-label">Sub Dimensi</label>
                            <div class="col-sm-6">
                                <select class="form-control subDimensi" name="subDimensi" id="subDimensi">
                                </select>
                                <?= form_error('subDimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="indikator" class="col-sm-2 col-form-label">Indikator</label>
                            <div class="col-sm-6">
                                <select class="form-control indikator" name="indikator" id="indikator">
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-6">
                                <select class="form-control tahun" name="tahun" id="tahun">
                                </select>
                                <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="privileges" class="col-sm-2 col-form-label">Nilai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control nilai" name="nilai" id="nilai" placeholder="Nilai" disabled>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg action text-right mt-2 mb-0">
                                <button type="submit" class="btn btn-danger tambah-user">
                                    <i class="fas fa-fw fa-trash"></i>Hapus Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->