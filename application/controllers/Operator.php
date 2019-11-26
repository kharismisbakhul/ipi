<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        $data['range_tahun'] = [];
        $data['col_span'] = 0;
        return $data;
    }

    public function loadTemplate($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
    }

    public function index()
    {
        if ($this->session->userdata('status_user') == 0) {
            redirect('admin');
        }
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $kode_dimensi = intval($this->session->userdata('status_user'));
        $dimensi = $this->db->select("nama_dimensi")->get('dimensi')->result_array();
        $nama_dimensi = [];
        foreach ($dimensi as $d) {
            array_push($nama_dimensi, $d['nama_dimensi']);
        }
        if ($kode_dimensi == 1) {
            $data['background'] = "bg-red";
        } else if ($kode_dimensi == 2) {
            $data['background'] = "bg-green";
        } else {
            $data['background'] = "bg-orange2";
        }
        $data['title'] = "Dashboard";
        $data['title2'] = $nama_dimensi[$kode_dimensi - 1];

        // echo json_encode($data['background']);
        // die;
        $this->loadTemplate($data);
        $this->load->view('menu/dashboard_operator', $data);
        $this->load->view('templates/footer');
    }
}
