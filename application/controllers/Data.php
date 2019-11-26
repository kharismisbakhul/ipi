<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }
    public function reset()
    {
        $start_time = microtime(true);
        $this->db->select('kode_indikator');
        $indikator = $this->db->get('indikator')->result_array();
        for ($i = 0; $i < count($indikator); $i++) {
            $kode_indikator = $indikator[$i]['kode_indikator'];
            // $kode_indikator = 1;
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIndikator($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIPI();
        }
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);
        echo json_encode($execution_time);
        die;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perhitungan ulang data berhasil</div>');
        redirect('report');
    }

    public function getDimensi()
    {
        $dimensi = $this->db->get('dimensi')->result_array();
        echo json_encode($dimensi);
    }
    public function getSubDimensi($kode_d)
    {
        $sub_dimensi = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        echo json_encode($sub_dimensi);
    }
    public function getIndikator($kode_sd)
    {
        $indikator = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        echo json_encode($indikator);
    }
    public function getNilai()
    {
        $kode_i = $this->input->get('i');
        $tahun = $this->input->get('t');
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $this->db->where('kode_indikator', $kode_i);
        $this->db->where('tahun', $tahun);
        $data = $this->db->get()->row_array();
        echo json_encode($data);
    }
    public function getTahun()
    {
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        $result = $this->db->get()->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, $result[$i]['tahun']);
        }
        echo json_encode($tahun);
    }
    public function getDataChart()
    {
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $start = intval($this->uri->segment(3));
        $end = intval($this->uri->segment(4));
        $data = [];
        if ($start == 0 || $end == 0) {
            $tahun_terakhir = $this->kalkulasi->tahunTerakhirDataSemuaIndikator();
            $start_date = 2012;
        } else {
            $tahun_terakhir = $end;
            $start_date = $start;
        }
        $data['range_tahun'] = $this->admin->getRangeTahun($start_date, $tahun_terakhir);
        $range_tahun = $tahun_terakhir - $start_date + 1;

        // echo json_encode($start_date);
        // echo json_encode($tahun_terakhir);
        // die;

        $this->db->where('tahun <=', $tahun_terakhir);
        $result = $this->db->get('tahun')->result_array();
        $data['col_span'] = $range_tahun;

        $data['tahun'] = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($data['tahun'], $result[$i]['tahun']);
        }
        $Dimensi = $this->db->get('dimensi')->result_array();;
        $subdimensi = $this->db->get('subdimensi')->result_array();
        $data['ipi']['nilai'] = [];
        $data['ipi']['nama_ipi'] = 'Indeks Pembangunan Inklusif';
        for ($i = 0; $i < count($Dimensi); $i++) {
            $data['dimensi'][$i]['nilai'] = [];
            $data['dimensi'][$i]['nama_dimensi'] = $Dimensi[$i]['nama_dimensi'];
            $data['subdimensi_d'][$i] = $this->admin->getSubDimensiSajaRange(($i + 1), $start_date, $tahun_terakhir);
        }

        for ($i = 0; $i < count($Dimensi); $i++) {
            for ($j = 0; $j < count($data['subdimensi_d'][$i]); $j++) {
                $data['subdimensi_d'][$i][$j]['nilai'] = [];
            }
        }

        for ($i = 0; $i < count($subdimensi); $i++) {
            $data['subDimensi'][$i]['nilai'] = [];
            $data['subDimensi'][$i]['nama_sub_dimensi'] = $subdimensi[$i]['nama_sub_dimensi'];
            $data['indikator_sd'][$i] = $this->admin->getIndikatorRange(($i + 1), $start_date, $tahun_terakhir);
        }

        //Data Indikator
        for ($i = 0; $i < count($subdimensi); $i++) {
            for ($j = 0; $j < count($data['indikator_sd'][$i]); $j++) {
                $data['indikator_sd'][$i][$j]['nilai'] = [];
            }
        }



        //Loop Data
        for ($j = 0; $j < $range_tahun; $j++) {
            $tahunSelect = $start_date++;
            //Data IPI
            $data_IPI_sesuai_tahun = $this->admin->getIPIPerTahun($tahunSelect);
            $rescale_IPI = doubleval($data_IPI_sesuai_tahun['nilai_rescale']);
            array_push($data['ipi']['nilai'], round($rescale_IPI, 2));


            for ($d = 0; $d < count($Dimensi); $d++) {
                //Data Dimensi
                $data_Dimensi_sesuai_tahun = $this->admin->getNilaiDimensiPerTahun(($d + 1), $tahunSelect);
                $rescale_Dimensi = doubleval($data_Dimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['dimensi'][$d]['nilai'], round($rescale_Dimensi, 2));
                for ($i = 0; $i < count($data['subdimensi_d'][$d]); $i++) {
                    $kode_sd = $data['subdimensi_d'][$d][$i]['kode_sd'];
                    $data_sd_sesuai_tahun = $this->admin->getNilaiSubDimensiPerTahun($kode_sd, $tahunSelect);
                    $rescale_sd = doubleval($data_sd_sesuai_tahun['nilai_rescale']);
                    array_push($data['subdimensi_d'][$d][$i]['nilai'], round($rescale_sd, 2));
                }
            }

            for ($sd = 0; $sd < count($subdimensi); $sd++) {
                $data_subDimensi_sesuai_tahun = $this->admin->getNilaiSubDimensiPerTahun(($sd + 1), $tahunSelect);
                $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['subDimensi'][$sd]['nilai'], round($rescale_subDimensi, 2));
                for ($i = 0; $i < count($data['indikator_sd'][$sd]); $i++) {
                    $kode_indikator = $data['indikator_sd'][$sd][$i]['kode_indikator'];
                    $data_indikator_sesuai_tahun = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahunSelect);
                    $rescale_indikator = doubleval($data_indikator_sesuai_tahun['nilai_rescale']);
                    array_push($data['indikator_sd'][$sd][$i]['nilai'], round($rescale_indikator, 2));
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function getTahunSelected($tahun)
    {
        $this->db->where('tahun >', intval($tahun));
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        $result = $this->db->get()->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, $result[$i]['tahun']);
        }
        echo json_encode($tahun);
    }
}
