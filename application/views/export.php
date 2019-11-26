<!DOCTYPE html>
<html>

<head>
    <title>Export Table</title>
    <style type="text/css">
        table thead tr th {
            background-color: #485460;
            color: #ecf0f1;
            color: white;
            border: 1px solid black;
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

        .nama_indikator {
            text-align: left;
        }

        .nama_dimensi {
            text-align: left;
        }

        .nama_sub_dimensi {
            text-align: left;
        }
    </style>
</head>

<body>

    <?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Report.xls");
    ?>

    <table class="table table-report text-wrap">
        <thead class="">
            <tr>
                <th rowspan="2" colspan="3">Kode</th>
                <th rowspan="2">Dimensi</th>
                <?php if ($segment === "asli") { ?>
                <th colspan="<?= $col_span ?>">Data Indikator Sosial Ekonomi</th>
                <?php } else { ?>
                <th colspan="<?= $col_span ?>">Data Indeks Sosial Ekonomi</th>
                <?php } ?>
            </tr>
            <tr>
                <!-- Tahun Nilai Indikator -->
                <?php foreach ($range_tahun as $rt) : ?>
                <th scope="col"><?= $rt['tahun'] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody style="color: #101010">
            <!-- IPI Column -->
            <tr id="ipi">
                <td colspan="4">Indeks Pembangunan Inklusif</td>
                <?php if ($segment === "asli") { ?>
                <?php foreach ($range_tahun as $rt) : ?>
                <td scope="col"></td>
                <?php endforeach; ?>
                <?php } else { ?>
                <?php foreach ($ipi as $i) : ?>
                <td><?= $i['nilai_rescale'] ?></td>
                <?php endforeach; ?>
                <?php } ?>
            </tr>
            <!-- IPI Column End -->

            <?php for ($d = 0; $d < $jumlahData['jumlah_d']; $d++) { ?>
            <!-- Dimensi -->
            <tr class="dimensiD" id="dimensiD">
                <td><?= ($d + 1); ?></td>
                <td></td>
                <td></td>
                <td class="nama_dimensi"><?= $dimensi[$d]['nama_dimensi'] ?></td>
                <?php if ($segment === "asli") { ?>
                <?php foreach ($range_tahun as $rt) : ?>
                <td scope="col"></td>
                <?php endforeach; ?>
                <?php } else { ?>
                <?php foreach ($dimensi[$d]['nilai_rescale'] as $nr) : ?>
                <td class=""><?= $nr ?></td>
                <?php endforeach; ?>
                <?php } ?>
            </tr>
            <?php $jumlahSubDimensi = $jumlahData['detail'][$d]['subDimensi']['jumlah_sd'];
                for ($sd = 0; $sd < $jumlahSubDimensi; $sd++) { ?>
            <!-- Sub Dimensi -->
            <tr class="sub-dimensiSD" id="sub-dimensiSD">
                <td></td>
                <td><?= ($sd + 1); ?></td>
                <td></td>
                <td class="nama_sub_dimensi"><?= $dimensi[$d]['subDimensi'][$sd]['nama_sub_dimensi'] ?></td>
                <?php if ($segment === "asli") { ?>
                <?php foreach ($range_tahun as $rt) : ?>
                <td scope="col"></td>
                <?php endforeach; ?>
                <?php } else { ?>
                <?php foreach ($dimensi[$d]['subDimensi'][$sd]['nilai_rescale'] as $snr) : ?>
                <td class=""><?= $snr ?></td>
                <?php endforeach; ?>
                <?php } ?>
            </tr>
            <?php $jumlahIndikator = $jumlahData['detail'][$d]['subDimensi']['detail'][$sd]['indikator']['jumlah_indikator']; ?>
            <?php for ($ind = 0; $ind < $jumlahIndikator; $ind++) { ?>
            <!-- Indikator -->
            <tr class="indikator" id="indikator">
                <?php $id = "";
                            $indikator = $dimensi[$d]['subDimensi'][$sd]['indikator'];
                            if ($indikator[$ind]['status'] == 1) {
                                $id = "status1";
                            } elseif ($indikator[$ind]['status'] == 2) {
                                $id = "status2";
                            }
                            ?>
                <td class=""></td>
                <td class=""></td>
                <td class="" id="<?= $id ?>"><?= $ind + 1; ?></td>
                <td class="nama_indikator" id="<?= $id ?>"><?= $indikator[$ind]['nama_indikator'] ?></td>
                <?php if ($segment === "asli") { ?>
                <?php foreach ($indikator[$ind]['nilai_eksisting'] as $ine) : ?>
                <td class=""><?= $ine ?></td>
                <?php endforeach; ?>
                <?php } else { ?>
                <?php foreach ($indikator[$ind]['nilai_rescale'] as $inr) : ?>
                <td class=""><?= $inr ?></td>
                <?php endforeach; ?>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <!-- End Data -->
        </tbody>
    </table>

</body>

</html>