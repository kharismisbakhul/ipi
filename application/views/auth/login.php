<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/');  ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/');  ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/custom/login.css">

</head>

<body class="bg-blue">

  <div class="container mt-4" style="width: 100%; height: 100%;">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-sm-12 col-lg-12 col-md-12 mt-3">
        <div class="card o-hidden border-0 shadow-lg my-5" style="width: 100%;">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block text-center ml-4 mt-5">
                <img src="<?= base_url('assets/img/login_page_1.svg') ?>" class="rounded mx-auto d-block mt-5" style="width: 100%;">
              </div>
              <div class="col-lg-5 col-sm-12 mx-auto">
                <div class="pt-5">
                  <div class="text-center div-title">
                    <h2 class="h4 title mb-2 mt-0 font-weight-bold" style="color:black;">IPI APPS</h2>
                    <h6 class="sub-title mb-3 font-weight-normal" style="font-size: 0.6rem;">Untuk menggunakan sistem ini harap untuk login menggunakan<br> username dan password yang sudah terdaftar</h6>
                  </div>
                  <?= $this->session->flashdata('message');  ?>
                  <form class="user" method="post" action="<?= base_url('auth'); ?>">
                    <div class="form-group">
                      <label for="username" style="font-size: 0.8rem;">Username</label>
                      <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username" value="<?= set_value('username'); ?>" style=" border-radius:10px;">
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="password" style="font-size: 0.8rem;">Password</label>
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" style="border-radius:10px;">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block loginSubmit" style="font-size: 1rem; border-radius:10px;">
                      Masuk
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  </div>
  <p class="text-center" style="margin-top: -30px; font-size: .7rem; color: white;">Copyright © <?= date('Y') ?> PKEPK FEB UB. All Rights Reserved. </p>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/');  ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/');  ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/');  ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/');  ?>js/sb-admin-2.min.js"></script>

</body>

</html>