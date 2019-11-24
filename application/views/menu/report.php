<style type="text/css">
    table thead tr th {
        background-color: #485460;
        color: #ecf0f1;
        border: 1px black;
    }

    table thead tr th,
    table tbody tr td {
        font-family: 'Calibri', sans-serif;
        color: black;
        font-size: 14px;
        border: 1px solid black;
        text-align: center;
    }

    table thead tr th {
        color: white;
    }

    #ipi td {
        background-color: yellow;
        text-align: center;
        color: black;
    }

    #dimensiD td {
        background-color: #3498db;
        color: white;
    }

    #sub-dimensiSD td {
        background-color: #fa8231;
        color: black;
    }

    #status1 {
        background-color: #e74c3c;
        color: white;
    }

    #status2 {
        background-color: #f9ca24;
        color: black;
    }
</style>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2">
        <div class="col-sm-0">
            <i class="fas fa-fw fa-file-alt"></i>
        </div>
        <div class="col-sm-6">
            <h1 class="h3 text-gray-800"><?= $title; ?> Data</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-center">
                        <?= $title;  ?> : Indeks Pembangunan Inklusif - Data Indeks Sosial Ekonomi
                    </div>
                </div>
                <div class="card-body global">
                    <div class="text-center report">
                        <div id="progressTimer"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 data-report">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 510px">
                                    <div class="loading-progress"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->