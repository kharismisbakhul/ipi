<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-midnight-blue text-white">
                    <h6 class="m-0 font-weight-bold">Edit User</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?= base_url('admin/edituser/') . $id_temp ?>" method="post">



                        <div class="form-group row">
                            <label for="usernameadd" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="usernameadd" name="usernameadd" placeholder="Username" value="<?= $detailUser['username']; ?>">
                                <?= form_error('usernameadd', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordadd" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="passwordadd" name="passwordadd" placeholder="Password">
                                <?= form_error('passwordadd', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password2" class="col-sm-4 col-form-label">Masukkan Ulang Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                            </div>
                        </div>

                        <!-- Privileges -->
                        <div class="form-group row">
                            <label for="privileges" class="col-sm-4 col-form-label">Status User</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="privileges" id="privileges">
                                    <?php foreach ($status_user as $su) : ?>
                                        <option value="<?= $su['id'] ?>"><?= $su['menu'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg action text-right mt-2 mb-0">
                                <button class="btn btn-secondary">
                                    <a href="<?= base_url('admin/manajemenUser'); ?>" style="text-decoration: none; color: white;">
                                        <i class="fas fa-fw fa-times"></i>Kembali
                                    </a>
                                </button>
                                <button type="submit" class="btn btn-success tambah-user">
                                    <i class="fas fa-fw fa-plus"></i>Edit User
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