    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row ml-2">
                    <div class="col-sm-0">
                        <i class="fas fa-fw fa-user-friends"></i>
                    </div>
                    <div class="col-sm-6">
                        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-6 mb-4">
                                <!-- Approach -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 bg-midnight-blue">
                                        <h6 class="m-0 font-weight-bold text-capitalize text-white text-center">Daftar Pengguna</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="col-lg-12 text-right mb-2">
                                                <button type="button" class="btn btn-success mb-2">
                                                    <a href="<?= base_url('admin/tambahUser'); ?>" style="text-decoration: none; color: white;"><i class="fas fa-fw fa-plus"></i> Tambah User</a>
                                                </button>
                                            </div>
                                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                                <thead style="text-align: center" class="bg-midnight-blue text-white">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Pengguna</th>
                                                        <th>Status Pengguna</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($list_user as $lu) : ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i; ?></td>
                                                            <td><?= $lu['username']; ?></td>
                                                            <td><?= $lu['menu']; ?></td>
                                                            <td class="text-center">
                                                                <button type="button" class="badge badge-pill badge-danger text-white delete-user" value="<?= $lu['id']; ?>">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-fw fa-trash-alt"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </button>
                                                                <button type="button" class="badge badge-pill badge-primary ">
                                                                    <a href="<?= base_url('admin/editUser/') . $lu['id']; ?>" style="text-decoration: none; color: white;">
                                                                        <span class=" icon text-white-50">
                                                                            <i class="fas fa-fw fa-pencil-alt"></i>
                                                                        </span>
                                                                        <span class="text">Ubah</span>
                                                                    </a>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Alert Delete User -->
        <!-- End Alert Delete User -->