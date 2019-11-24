<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kalkulasi_model extends CI_Model
{
    //Duplikasi DB
    public function kalkulasiReScaleFilter($start, $end)
    {
        $this->db->select('kode_indikator');
        $result = $this->db->get('indikator')->result_array();
        for ($i = 0; $i < count($result); $i++) {
            $kode_indikator = $result[$i]['kode_indikator'];
            $this->setNilaiMin($kode_indikator, $start, $end);
            $this->setNilaiMax($kode_indikator, $start, $end);
        }
    }

    //Set Nilai max indikator tertentu
    public function setNilaiMax($kode_indikator)
    {
        // $this->db->select('kode_indikator, nilai');
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai = count($result);
        $max = $result[0];
        for ($i = 0; $i < ($jumlah_data_nilai - 1); $i++) {
            if (doubleval($max['nilai']) < doubleval($result[$i + 1]['nilai'])) {
                $max = $result[$i + 1];
            }
        }
        $data = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();

        $finalMax = doubleval($max['nilai']);
        //Update Nilai Max
        $data = [
            'kode_indikator' => $kode_indikator,
            'nama_indikator' => $data['nama_indikator'],
            'status' => $data['status'],
            'min_nilai' => $data['min_nilai'],
            'max_nilai' => $finalMax,
            'kode_sd' => $data['kode_sd']
        ];
        $this->db->set($data);
        $this->db->where('kode_indikator', $kode_indikator);

        $this->db->update('indikator');

        // echo json_encode($finalMax);
    }

    //Set Nilai min indikator tertentu
    public function setNilaiMin($kode_indikator)
    {
        // $this->db->select('kode_indikator, nilai');
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai = count($result);
        $min = $result[0];
        for ($i = 0; $i < ($jumlah_data_nilai - 1); $i++) {
            if (doubleval($min['nilai']) > doubleval($result[$i + 1]['nilai'])) {
                $min = $result[$i + 1];
            }
        }
        if (count($result) == 1 && $min['tahun'] != 2012) {
            $finalMin = 0;
        } else {
            $finalMin = doubleval($min['nilai']);
        }
        $data = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();

        //Update Nilai Min
        $data = [
            'kode_indikator' => $kode_indikator,
            'nama_indikator' => $data['nama_indikator'],
            'status' => $data['status'],
            'min_nilai' => $finalMin,
            'max_nilai' => $data['max_nilai'],
            'kode_sd' => $data['kode_sd']
        ];
        $this->db->set($data);
        $this->db->where('kode_indikator', $kode_indikator);

        $this->db->update('indikator');

        // echo json_encode($finalMin);
    }

    public function tahunTerakhirDataIndikator($kode_indikator)
    {
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->where('nilai !=', 0);
        $this->db->select('MAX(tahun) as tahun_terakhir');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        $tahun = intval($result['tahun_terakhir']);
        return $tahun;
        // echo json_encode($tahun);
    }
    public function tahunTerakhirDataSemuaIndikator()
    {
        $this->db->where('nilai !=', 0);
        $this->db->select('MAX(tahun) as tahun_terakhir');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        $tahun = intval($result['tahun_terakhir']);
        return $tahun;
        // echo json_encode($tahun);
    }

    //Set Nilai rescale Indikator tiap tahun
    public function setNilaiRescaleIndikator($kode_indikator)
    {
        //Ambil indikator

        $data_indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        //Ambil data tahun
        $tahun_terakhir = $this->tahunTerakhirDataSemuaIndikator();
        $tahun_awal = 2012;

        $kode_sd = intval($data_indikator['kode_sd']);
        $max = doubleval($data_indikator['max_nilai']);
        $min = doubleval($data_indikator['min_nilai']);
        $status = doubleval($data_indikator['status']);

        //Range Tahun
        $range_tahun = $tahun_terakhir - $tahun_awal + 1;

        $this->load->model('Admin_model', 'admin');

        for ($j = 0; $j < $range_tahun; $j++) {
            $tahun = $tahun_awal++;
            $nilai_data_indikator = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahun);
            if ($nilai_data_indikator == null) {
                $nilai_eksisting_perTahun = 0;
            } else {
                $nilai_eksisting_perTahun = $nilai_data_indikator['nilai'];
            }
            // $nilai_rescale = 0;
            if (($max - $min) == 0) {
                $nilai_rescale = 0;
            } else {
                if ($status == 0) {
                    //Rumus (putih) --> ((eksisting sesuai tahun - min)/(max-min))*10 
                    $nilai_rescale = (($nilai_eksisting_perTahun - $min) / ($max - $min)) * 10;
                } else if ($status == 1 && $kode_sd == 4) {
                    //Rumus (merah - IPK) --> (((eksisting sesuai tahun - min)/(max-min))*-10)+10 
                    $nilai_rescale = ((($nilai_eksisting_perTahun - $min) / ($max - $min)) * (-10)) + 10;
                } else {
                    //Rumus (merah) --> ((max - eksisting sesuai tahun - min)/(max-min))*10 
                    $nilai_rescale = (($max - $nilai_eksisting_perTahun) / ($max - $min)) * 10;
                }
            }
            $data = array(
                'tahun' => $tahun,
                'nilai' => $nilai_eksisting_perTahun,
                'nilai_rescale' => $nilai_rescale,
                'kode_indikator' => $kode_indikator
            );
            if ($nilai_data_indikator == null) {
                // Insert Nilai ReScale indikator
                $this->db->insert('nilaiindikator', $data);
            } else {
                //Update Nilai ReScale Indikator
                // $data = array('nilai_rescale' => $nilai_rescale);
                $this->db->set($data);
                $this->db->where('tahun', $tahun);
                $this->db->where('kode_indikator', $kode_indikator);
                $this->db->update('nilaiindikator');
            }
        }

        // echo json_encode($indikator);
    }

    //Set Nilai rescale Sub Dimensi tiap tahun
    public function setNilaiRescaleSubDimensi($kode_indikator)
    {
        //Ambil data tahun
        $tahun_terakhir = $this->tahunTerakhirDataSemuaIndikator();
        $tahun_awal = 2012;

        //Ambil indikator
        $indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($indikator['kode_sd']);
        $this->load->model('Admin_model', 'admin');

        //Ambil Semua indikator sesuai subDimensi
        $data_indikator =  $this->admin->getIndikator($kode_sd);
        $jumlah_data_indikator = count($data_indikator);
        // Range Tahun
        $range_tahun = $tahun_terakhir - $tahun_awal + 1;

        for ($j = 0; $j < $range_tahun; $j++) {
            $nilai_rescale_subDimensi_temp = 0;
            $tahun = $tahun_awal++;
            for ($i = 0; $i < $jumlah_data_indikator; $i++) {
                $kode_indikator = intval($data_indikator[$i]['kode_indikator']);
                $nilai_data_indikator = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahun);
                $nilai_rescale_indikator = doubleval($nilai_data_indikator['nilai_rescale']);
                $nilai_rescale_subDimensi_temp += $nilai_rescale_indikator;
            }
            $nilai_rescale_subDimensi = $nilai_rescale_subDimensi_temp / $jumlah_data_indikator;

            $nilai_data_subDimensi = $this->admin->getNilaiSubDimensiPerTahun($kode_sd, $tahun);
            if ($nilai_data_subDimensi == null) {
                // Insert Nilai ReScale SubDimensi
                $data = array(
                    'tahun' => $tahun,
                    'nilai_rescale' => $nilai_rescale_subDimensi,
                    'kode_sd' => $kode_sd
                );
                $this->db->insert('nilaisubdimensi', $data);
            } else {
                //Update Nilai ReScale SubDimensi
                $data = array('nilai_rescale' => $nilai_rescale_subDimensi);
                $this->db->set($data);
                $this->db->where('tahun', $tahun);
                $this->db->where('kode_sd', $kode_sd);

                $this->db->update('nilaisubdimensi');
            }
        }

        // echo json_encode($jumlah_data_indikator);
    }

    //Set Nilai rescale Dimensi tiap tahun
    public function setNilaiRescaleDimensi($kode_indikator)
    {
        //Ambil data tahun
        $tahun_terakhir = $this->tahunTerakhirDataSemuaIndikator();
        $tahun_awal = 2012;

        //Ambil detail indikator
        $indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($indikator['kode_sd']);

        $this->load->model('Admin_model', 'admin');

        //Ambil SubDimensi
        $subDimensi = $this->db->get_where('subDimensi', ['kode_sd' => $kode_sd])->row_array();
        $kode_d = intval($subDimensi['kode_d']);

        //Ambil Semua subDimensi sesuai Dimensi
        $data_subDimensi =  $this->admin->getsubDimensi($kode_d);
        $jumlah_data_subDimensi = count($data_subDimensi);

        //Range Tahun
        $range_tahun = $tahun_terakhir - $tahun_awal + 1;

        for ($j = 0; $j < $range_tahun; $j++) {
            $nilai_rescale_Dimensi_temp = 0;
            $tahun = $tahun_awal++;
            for ($i = 0; $i < $jumlah_data_subDimensi; $i++) {
                $kode_subDimensi = intval($data_subDimensi[$i]['kode_sd']);
                $nilai_data_subDimensi = $this->admin->getNilaiSubDimensiPerTahun($kode_subDimensi, $tahun);
                $nilai_rescale_subDimensi = doubleval($nilai_data_subDimensi['nilai_rescale']);
                $nilai_rescale_Dimensi_temp += $nilai_rescale_subDimensi;
            }
            $nilai_rescale_Dimensi = $nilai_rescale_Dimensi_temp / $jumlah_data_subDimensi;

            $nilai_data_Dimensi = $this->admin->getNilaiDimensiPerTahun($kode_d, $tahun);
            if ($nilai_data_Dimensi == null) {
                // Insert Nilai ReScale Dimensi
                $data = array(
                    'tahun' => $tahun,
                    'nilai_rescale' => $nilai_rescale_Dimensi,
                    'kode_d' => $kode_d
                );
                $this->db->insert('nilaidimensi', $data);
            } else {
                //Update Nilai ReScale Dimensi
                $data = array('nilai_rescale' => $nilai_rescale_Dimensi);
                $this->db->set($data);
                $this->db->where('tahun', $tahun);
                $this->db->where('kode_d', $kode_d);
                $this->db->update('nilaidimensi');
            }
        }
    }

    //Set Nilai rescale IPI tiap tahun
    public function setNilaiRescaleIPI()
    {
        //Ambil Dimensi
        $this->load->model('Admin_model', 'admin');
        $data_dimensi = $this->admin->getDimensi();
        $jumlah_data_dimensi = count($data_dimensi);

        //Ambil data tahun
        $tahun_terakhir = $this->tahunTerakhirDataSemuaIndikator();
        $tahun_awal = 2012;

        $range_tahun = $tahun_terakhir - $tahun_awal + 1;

        for ($j = 0; $j < $range_tahun; $j++) {
            $nilai_rescale_IPI_temp = 0;
            $tahun = $tahun_awal++;
            for ($i = 0; $i < $jumlah_data_dimensi; $i++) {
                $kode_dimensi = intval($data_dimensi[$i]['kode_d']);
                $nilai_data_dimensi = $this->admin->getNilaiDimensiPerTahun($kode_dimensi, $tahun);
                $nilai_rescale_dimensi = doubleval($nilai_data_dimensi['nilai_rescale']);
                $nilai_rescale_IPI_temp += $nilai_rescale_dimensi;
            }
            $nilai_rescale_IPI = $nilai_rescale_IPI_temp / $jumlah_data_dimensi;

            $nilai_data_IPI = $this->admin->getIPIPerTahun($tahun);
            if ($nilai_data_IPI == null) {
                // Insert Nilai ReScale IPI
                $data = array(
                    'tahun' => $tahun,
                    'nilai_rescale' => $nilai_rescale_IPI
                );
                $this->db->insert('ipi', $data);
            } else {
                //Update Nilai ReScale SubDimensi
                $data = array('nilai_rescale' => $nilai_rescale_IPI);
                $this->db->set($data);
                $this->db->where('tahun', $tahun);
                $this->db->update('ipi');
            }
        }
    }
}
