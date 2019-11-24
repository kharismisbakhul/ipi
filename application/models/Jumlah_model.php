<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jumlah_model extends CI_Model
{
    public function getJumlahDimensi()
    {
        $this->db->select('kode_d');
        $dimensi['detail'] = $this->db->get('dimensi')->result_array();
        $dimensi['jumlah_d'] = count($dimensi['detail']);
        for ($i = 0; $i < count($dimensi['detail']); $i++) {
            $kode_d = $dimensi['detail'][$i]['kode_d'];
            $dimensi['detail'][$i]['subDimensi'] = $this->getJumlahSubDimensi($kode_d);
        }
        return $dimensi;
    }
    public function getJumlahSubDimensi($kode_d)
    {
        $this->db->select('kode_sd');
        $subDimensi['detail'] = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        $subDimensi['jumlah_sd'] = count($subDimensi['detail']);
        for ($i = 0; $i < count($subDimensi['detail']); $i++) {
            $kode_sd = $subDimensi['detail'][$i]['kode_sd'];
            $subDimensi['detail'][$i]['indikator'] = $this->getJumlahIndikator($kode_sd);
        }
        return $subDimensi;
    }
    public function getJumlahIndikator($kode_sd)
    {
        $this->db->select('kode_indikator');
        $indikator['detail'] = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        $indikator['jumlah_indikator'] = count($indikator['detail']);
        return $indikator;
    }
}
