<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <?php if ($this->session->userdata("status_user") == 0) { ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center brnd shadow" href="<?= base_url('admin'); ?>">
        <?php
        } else { ?>
            <a class="sidebar-brand d-flex align-items-center justify-content-center brnd shadow" href="<?= base_url('operator'); ?>">
            <?php
            } ?>

            <span class="sidebar-brand-text mx-3" style="color: #fff;">
                <span class="text-ipi">IPI APPS</span>
            </span>
            <div class="topbar-divider d-none d-sm-block"></div>
            </a>


            <!-- Divider -->

            <?php if ($title == "Dashboard") : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <?php if ($this->session->userdata("status_user") == 0) { ?>
                    <a class="nav-link mt-0 pt-0" href="<?= base_url('admin'); ?> ">
                    <?php
                    } else { ?>
                        <a class="nav-link mt-0 pt-0" href="<?= base_url('operator'); ?> ">
                        <?php
                        } ?>
                        <i class="fas fa-fw fa-university"></i>
                        <span>Dashboard</span>
                        </a>
                </li>
                <hr class="sidebar-divider">

                <!-- Menu Heading -->
                <?php if ($this->session->userdata("status_user") == 0) { ?>
                    <div class="sidebar-heading">
                        Administrator
                    </div>

                <?php
                } ?>

                <!-- Menu -->
                <!-- Input Data -->
                <?php if ($title == "Input Data") : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url('inputData'); ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Input Data</span>
                    </a>
                    </li>


                    <?php if ($this->session->userdata("status_user") == 0) { ?>
                        <!-- Global/IPI -->
                        <?php if ($title == "Indeks Pembangunan Inklusif") : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a class="nav-link pb-0" href="<?= base_url('admin/ipi'); ?>">
                                <i class="fas fa-fw fa-chart-bar"></i>
                                <span>Indeks Pembangunan<br><span class="ml-4"> Inklusif</span></span>
                            </a>
                            </li>

                        <?php
                        }; ?>
                        <?php $subDimensi = $this->db->get('subdimensi')->result_array(); ?>
                        <?php $dimensi = $this->db->get('dimensi')->result_array(); ?>
                        <!-- Nav Item - Pages Collapse Menu -->

                        <!-- Updated -->

                        <!-- Aktivitas Ekonomi -->
                        <?php foreach ($dimensi as $d) : ?>
                            <?php if ($this->session->userdata("status_user") == 0 || $this->session->userdata("status_user") == intval($d['kode_d'])) { ?>
                                <?php if ($title == $d['nama_dimensi']) : ?>
                                    <li class="nav-item active">
                                    <?php else : ?>
                                    <li class="nav-item">
                                    <?php endif; ?>
                                    <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#coleps<?= $d['kode_d'] ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fas fa-fw fa-chart-bar"></i>
                                        <?php $n_dimensi = explode(" ", $d['nama_dimensi']); ?>
                                        <span>
                                            <?php for ($i = 0; $i < count($n_dimensi); $i++) : ?>
                                                <?php if ($i != 2) : ?>
                                                    <?= $n_dimensi[$i] . ' ' ?>
                                                <?php else : ?>

                                                    <br><span class="ml-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $n_dimensi[$i] ?> </span>

                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </span>
                                    </a>
                                    <!-- Menu Dropdown -->
                                    <div id="coleps<?= $d['kode_d'] ?>" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <a class="collapse-item" href="<?= base_url('admin/dimensi?d=') . $d['kode_d'] ?>">
                                                <span>
                                                    <?php for ($i = 0; $i < count($n_dimensi); $i++) : ?>
                                                        <?php if ($i != 2) : ?>
                                                            <?= $n_dimensi[$i] . ' ' ?>
                                                        <?php else : ?>
                                                            <br><span class="ml-0"><?= $n_dimensi[$i] ?> </span>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </span>
                                            </a>

                                            <?php foreach ($subDimensi as $sd) :
                                                        if ($sd['kode_d'] == $d['kode_d']) {
                                                            $str = $sd['nama_sub_dimensi'];
                                                            $result = explode(" ", $str);
                                                            if (count($result) < 3) {
                                                                ?>
                                                        <a class="collapse-item" href="<?= base_url('admin/subdimensi?sd=') . $sd['kode_sd'] ?>"> <?= $str ?></a>
                                                    <?php
                                                                    } else {
                                                                        ?>
                                                        <a class="collapse-item" href="<?= base_url('admin/subdimensi?sd=') . $sd['kode_sd'] ?>"><span><?= $result[0] . " " . $result[1] . " " ?><br><span class="ml-0"><?= $result[2] ?></span></span></a>
                                            <?php
                                                            }
                                                        };
                                                    endforeach; ?>
                                        </div>
                                        <!-- -- Updated -->
                                    </div>
                                    </li>
                                <?php
                                    }; ?>
                            <?php endforeach; ?>

                            <!-- Report -->
                            <?php if ($title == "Report") : ?>
                                <li class="nav-item active">
                                <?php else : ?>
                                <li class="nav-item">
                                <?php endif; ?>
                                <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#colepsReport" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    <span>Report</span>
                                </a>
                                <!-- Menu Dropdown -->
                                <div id="colepsReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <span>
                                            <a class="collapse-item" href="<?= base_url('admin/report/asli') ?>">Data Indikator Sosial<br>Ekonomi</a>

                                        </span>
                                    </div>
                                    <!-- -- Updated -->
                                </div>
                                </li>



                                <!-- Divider -->
                                <hr class="sidebar-divider mt-3 mb-0">

                                <li class="nav-item">
                                    <a class="nav-link logout" href="<?= base_url('auth/logout') ?>">
                                        <i class="fas fa-fw fa-power-off"></i>
                                        <span>logout</span>
                                    </a>
                                </li>

                                <!-- Sidebar Toggler (Sidebar) -->
                                <div class="text-center d-none d-md-inline">
                                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                                </div>

</ul>
<!-- End of Sidebar -->