<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function loadTemplate($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
    }

    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        return $data;
    }

    public function index()
    {
        $data = $this->initData();
        $data['title'] = 'Input Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim', [
            'required' => 'Nilai tidak boleh kosong!!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/inputData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            if ($indikator == null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal Diperbarui</div>');
                redirect('inputData');
            }
            $kode_indikator =  $indikator;
            $tahun = intval($this->input->post('tahun'));
            $nilai = doubleval($this->input->post('nilai'));
            $data = array(
                'tahun' => $tahun,
                'nilai' => $nilai,
                'kode_indikator' => $kode_indikator
            );
            $this->db->set($data);
            $this->db->where('kode_indikator', $kode_indikator);
            $this->db->where('tahun', $tahun);
            $this->db->update('nilaiindikator');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Diperbarui</div>');

            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIndikator($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIPI();

            redirect('inputData');
        }
    }

    public function tambahIndikator()
    {
        $this->load->model('Admin_model', 'admin');
        $Dimensi = $this->input->post('modal-dimensi');
        $kode_sd = $this->input->post('modal-subDimensi');
        $nama_indikator = $this->input->post('modal-indikator');
        $status = $this->input->post('modal-status');
        $status_kode = 0;
        if ($status === "Merah") {
            $status_kode = 1;
        } else if ($status == "Putih") {
            $status_kode = 0;
        } else {
            $status_kode = 2;
        }

        $data = array(
            'nama_indikator' => $nama_indikator,
            'status' => $status_kode,
            'kode_sd' => $kode_sd
        );

        if ($Dimensi == "Pilih Dimensi" && $kode_sd == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dimensi Belum ada yang dipilih</div>');
        } else if ($kode_sd == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Dimensi belum ada yang dipilih</div>');
        } else {
            $cek_indikator =  $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator])->row_array();
            if ($cek_indikator != null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Indikator sudah ada!!</div>');
            } else {
                $this->db->insert('indikator', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil ditambahkan</div>');
            }
        }

        $this->db->select('MIN(tahun) as tahun');
        $this->db->from('nilaiindikator');
        $tahun_min = $this->db->get()->row_array();

        $this->db->select('MAX(tahun) as tahun');
        $this->db->from('nilaiindikator');
        $tahun_max = $this->db->get()->row_array();

        $indikator = $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator])->row_array();
        for ($i = intval($tahun_min['tahun']); $i <= intval($tahun_max['tahun']); $i++) {
            $dataNilai = array(
                'tahun' => $i,
                'nilai' => 0,
                'kode_indikator' => intval($indikator['kode_indikator'])
            );
            $this->db->insert('nilaiindikator', $dataNilai);
        }

        redirect('inputData');
    }
    public function tambahTahun()
    {
        $tahun = intval($this->input->post('tambah-tahun'));
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        $temp_tahun = $this->db->get()->result_array();
        $cek_tahun = true;
        for ($i = 0; $i < count($temp_tahun); $i++) {
            if (intval($temp_tahun[$i]['tahun']) == $tahun) {
                $cek_tahun = false;
            }
        }
        if ($cek_tahun == true) {
            $indikator = $this->db->get('indikator')->result_array();
            for ($i = 0; $i < count($indikator); $i++) {
                $kode_indikator = $indikator[$i]['kode_indikator'];
                $dataNilai = array(
                    'tahun' => $tahun,
                    'nilai' => 0,
                    'kode_indikator' => intval($kode_indikator)
                );
                $this->db->insert('nilaiindikator', $dataNilai);
                $this->load->model('Kalkulasi_model', 'kalkulasi');
                $this->kalkulasi->setNilaiMin($kode_indikator);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tahun berhasil ditambahkan!!</div>');
            redirect('inputData');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tahun sudah ada!!</div>');
            redirect('inputData');
        }
    }
    public function hapusIndikator()
    {

        $this->load->model('Admin_model', 'admin');
        $kode_indikator = $this->input->post('modal-indikator-hapus');
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('nilaiindikator');
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('indikator');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        // $temp_indikator = $this->db->get_where('indikator', ['kode_sd' => $kode_subDimensi])->row_array();
        // $kode_temp_indikator = intval($temp_indikator['kode_indikator']);
        // $this->kalkulasi->setNilaiRescaleSubDimensi($kode_temp_indikator);
        // $this->kalkulasi->setNilaiRescaleDimensi($kode_temp_indikator);
        // $this->kalkulasi->setNilaiRescaleIPI();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil dihapus</div>');
        redirect('inputData');
    }
    public function hapusDataDiTahun()
    {
        $tahun = intval($this->input->post('tahun'));
        $this->db->where('tahun', $tahun);
        $this->db->delete('nilaiindikator');
        //Kalkulasi Ulang MAX MIN
        $this->db->select('kode_indikator');
        $indikator = $this->db->get('indikator')->result_array();
        for ($i = 0; $i < count($indikator); $i++) {
            $kode_indikator = $indikator[$i]['kode_indikator'];
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tahun berhasil dihapus</div>');
        redirect('inputData');
    }


    public function hapusData()
    {
        $data = $this->initData();
        $data['title'] = 'Hapus Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/deleteData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            $kode_indikator = $this->admin->getKodeIndikator($indikator);
            $tahun = $this->input->post('tahun');
            $data = array(
                'tahun' => $tahun,
                'kode_indikator' => $kode_indikator
            );
            $this->db->delete('nilaiindikator', $data);
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIPI();

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil Dihapus</div>');
            redirect('admin/report');
        }
    }
    public function hai()
    {
        $data = array(
            'tahun' => 2012,
            'nilai' => 20,
            'kode_indikator' => 1
        );
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $this->db->set($data);
        $this->db->where('kode_indikator', 1);
        $this->db->where('tahun', 2012);
        $this->db->update('nilaiindikator');
        $this->kalkulasi->setNilaiMax(1);
        $this->kalkulasi->setNilaiMin(1);

        // var_dump(2012);
    }
}
