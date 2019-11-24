<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h2 mb-0 text-gray-800"><?= $title;  ?></h1>
    <div class="tanggal">
      <div class="text-s mb-0 font-weight-bold text-gray-400">
        <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
      </div>
    </div>
  </div>


  <div class="row">
    <!-- //Updated -->
    <div class="col-lg-12">
      <?= $this->session->flashdata('message');  ?>
    </div>
    <div class="d-none d-lg-block col-md-12 mb-4 box2">
      <div class="card shadow py-0">
        <div class="card-body dash">
          <div class="row no-gutters align-items-center">
            <div class="col ml-auto ">
              <div class="h5 mb-0 font-weight-normal">Hai <span id="user_name" class="font-weight-bold text-capitalize"><?= $username ?></span>, Selamat datang di IPI - Apps</div>
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

  <div class="row mt-4">
    <div class="col-lg-12 col-md-12 col-sm-12 box2">
      <div class="card shadow h-100">
        <div class="card-header bg-midnight-blue">
          <div class=" text-white text-sm font-weight-bold text-capitalize mb-1 text-center">
            Tabel : Indeks Pembangunan Inklusif
          </div>
        </div>
        <div class="card-body">
          <div class="row no-gutters align-items-center">

            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped text-center tClip">
                  <thead class="header-table-root ">
                    <tr style="background-color: #2c3e50; color: #FFFFFF" class="header-table">
                    </tr>
                    <tr style="background-color: #2c3e50; color: #FFFFFF" class="tahun-ipi">
                    </tr>
                  </thead>
                  <tbody class="iniDataIpi">

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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->