<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    //Updated

    public function getKodeDimensi($nama_d)
    {
        $this->db->where('nama_dimensi', $nama_d);
        $this->db->select('kode_d');
        $this->db->from('dimensi');
        $result = $this->db->get()->row_array();
        $kode_d = intval($result['kode_d']);
        return $kode_d;
    }
    public function getKodeSubDimensi($nama_sd)
    {
        $this->db->where('nama_sub_dimensi', $nama_sd);
        $this->db->select('kode_sd');
        $this->db->from('subdimensi');
        $result = $this->db->get()->row_array();
        $kode_sd = intval($result['kode_sd']);
        return $kode_sd;
    }
    public function getKodeIndikator($nama_indikator)
    {
        $this->db->where('nama_indikator', $nama_indikator);
        $this->db->select('kode_indikator');
        $this->db->from('indikator');
        $result = $this->db->get()->row_array();
        $kode_indikator = intval($result['kode_indikator']);
        return $kode_indikator;
    }
    public function getDimensiJson()
    {
        $result = $this->db->get('dimensi')->result_array();
        echo json_encode($result);
    }
    public function getSubDimensiJson($kode_d)
    {
        $result = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        echo json_encode($result);
    }
    public function getIndikatorJson($kode_sd)
    {
        $result = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        echo json_encode($result);
    }
    public function getNilaiIndikatorJson($kode_i, $tahun)
    {
        $this->db->where('kode_indikator', $kode_i);
        $this->db->where('tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        echo json_encode($result);
    }

    public function getSemuaTahun($star_date = null, $end_date = null)
    {

        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        if ($star_date != null && $end_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }

    public function getIPI($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('ipi');
        if ($star_date != null && $end_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }

    public function getIPIPerTahun($tahun)
    {
        $this->db->where('ipi.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('ipi');
        return $this->db->get()->row_array();
    }

    public function getDimensi()
    {
        return $this->db->get('dimensi')->result_array();
    }
    public function getNilaiDimensi($kode_d)
    {
        $this->db->where('kode_d', $kode_d);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }
    public function getNilaiDimensiPerTahun($kode_d, $tahun)
    {
        $this->db->where('kode_d', $kode_d);
        $this->db->where('tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->row_array();
    }


    public function getSubDimensi($kode_d)
    {
        return $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
    }

    public function getNilaiSubDimensi($kode_sd)
    {
        $this->db->where('kode_sd', $kode_sd);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->result_array();
    }
    public function getNilaiSubDimensiPerTahun($kode_sd, $tahun)
    {
        $this->db->where('kode_sd', $kode_sd);
        $this->db->where('tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->row_array();
    }

    public function getIndikatorRange($kode_sd, $start, $end)
    {
        $indikator_sd = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        for ($i = 0; $i < count($indikator_sd); $i++) {
            $kode_indikator = $indikator_sd[$i]['kode_indikator'];
            $indikator_sd[$i]['nilai_indikator'] = $this->getIndikatorRangeNilai($kode_indikator, $start, $end);
            $indikator_sd[$i]['nilai_rescale'] = [];
            $indikator_sd[$i]['nilai_eksisting'] = [];
            for ($j = 0; $j < count($indikator_sd[$i]['nilai_indikator']); $j++) {
                array_push($indikator_sd[$i]['nilai_rescale'], round($indikator_sd[$i]['nilai_indikator'][$j]['nilai_rescale'], 2));
                array_push($indikator_sd[$i]['nilai_eksisting'], round($indikator_sd[$i]['nilai_indikator'][$j]['nilai'], 2));
            }
        }
        // echo json_encode($indikator_sd);
        return $indikator_sd;
    }
    public function getIndikatorRangeNilai($kode_indikator, $start, $end)
    {
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        return $this->db->get()->result_array();
    }
    public function getSubDimensiRange($kode_d, $start, $end)
    {
        $subDimensi = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        for ($i = 0; $i < count($subDimensi); $i++) {
            $kode_sd = $subDimensi[$i]['kode_sd'];
            $subDimensi[$i]['nilai'] = $this->getSubDimensiRangeNilai($kode_sd, $start, $end);
            $subDimensi[$i]['indikator'] = $this->getIndikatorRange($kode_sd, $start, $end);
            $subDimensi[$i]['nilai_rescale'] = [];
            for ($j = 0; $j < count($subDimensi[$i]['nilai']); $j++) {
                array_push($subDimensi[$i]['nilai_rescale'], round($subDimensi[$i]['nilai'][$j]['nilai_rescale'], 2));
            }
        }
        // header('Content-Type: application/json');
        // echo json_encode($subDimensi);
        return $subDimensi;
    }
    public function getSubDimensiSajaRange($kode_d, $start, $end)
    {
        $subDimensi = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        for ($i = 0; $i < count($subDimensi); $i++) {
            $kode_sd = $subDimensi[$i]['kode_sd'];
            $subDimensi[$i]['nilai'] = $this->getSubDimensiRangeNilai($kode_sd, $start, $end);
        }
        // header('Content-Type: application/json');
        // echo json_encode($subDimensi);
        return $subDimensi;
    }

    public function getSubDimensiRangeNilai($kode_sd, $start, $end)
    {
        $this->db->where('kode_sd', $kode_sd);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->result_array();
    }
    public function getDimensiRange($start, $end)
    {
        $Dimensi = $this->db->get('dimensi')->result_array();
        for ($i = 0; $i < count($Dimensi); $i++) {
            $kode_d = $Dimensi[$i]['kode_d'];
            $Dimensi[$i]['nilai'] = $this->getDimensiRangeNilai($kode_d, $start, $end);
            $Dimensi[$i]['subDimensi'] = $this->getSubDimensiRange($kode_d, $start, $end);
            $Dimensi[$i]['nilai_rescale'] = [];
            for ($j = 0; $j < count($Dimensi[$i]['nilai']); $j++) {
                array_push($Dimensi[$i]['nilai_rescale'], round($Dimensi[$i]['nilai'][$j]['nilai_rescale'], 2));
            }
        }
        // header('Content-Type: application/json');
        // echo json_encode($Dimensi);
        return $Dimensi;
    }
    public function getDimensiRangeNilai($kode_d, $start, $end)
    {
        $this->db->where('kode_d', $kode_d);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }

    public function getTahunNilaiDimensi()
    {
        $this->db->select('tahun');
        $this->db->from('nilaidimensi');
        $this->db->group_by('tahun', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getDataPeriode()
    {
        $this->db->select('nilaidimensi.nilai_rescale,nilaidimensi.tahun_nilaidimensi,nilaidimensi.kode_d');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }
    public function getPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('ipi.tahun');
        $this->db->from('ipi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('tahun', 'ASC');
        $this->db->group_by('ipi.tahun');
        return $this->db->get()->result_array();
    }
    public function getNilaiDimensiPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('kode_d');
        return $this->db->get()->result_array();
    }
    public function getIpiPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('ipi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('id_nilai_ipi');
        return $this->db->get()->result_array();
    }

    public function getStatus($indikator)
    {
        $this->db->select('status , kode_indikator');
        $this->db->from('indikator');
        $this->db->where('kode_indikator', $indikator);
        return $this->db->get()->row_array();
    }

    public function getMax($indikator, $star_date = null, $end_date = null)
    {
        $this->db->select('MAX(nilai) as nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('kode_indikator', $indikator);
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->row_array();
    }
    public function getMin($indikator, $star_date = null, $end_date = null)
    {
        $this->db->select('MIN(nilai) as nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('kode_indikator', $indikator);
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->row_array();
    }
    public function getNilai($tahun, $indikator)
    {
        $this->db->select('nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('tahun', $tahun);
        $this->db->where('kode_indikator', $indikator);
        return $this->db->get()->row_array();
    }
    public function getTahun($star_date = null, $end_date = null)
    {
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
    public function getIndikator($sbdimensi, $star_date = null, $end_date = null)
    {
        $this->db->select('indikator.kode_indikator,nilaiindikator.tahun,indikator.kode_sd');
        $this->db->from('indikator');
        $this->db->join('nilaiindikator', 'indikator.kode_indikator = nilaiindikator.kode_indikator', 'left');
        $this->db->where('indikator.kode_sd', $sbdimensi);
        if ($star_date != null && $star_date != null) {
            $this->db->where('nilaiindikator.tahun >=', $star_date);
            $this->db->where('nilaiindikator.tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }

    public function getSubdimenasi($dimensi, $star_date = null, $end_date = null)
    {
        $this->db->select('subdimensi.kode_sd');
        $this->db->from('subdimensi');
        $this->db->join('nilaisubdimensi', 'subdimensi.kode_sd = nilaisubdimensi.kode_sd', 'left');
        $this->db->where('subdimensi.kode_d', $dimensi);
        if ($star_date != null && $star_date != null) {
            $this->db->where('nilaisubdimensi.tahun >=', $star_date);
            $this->db->where('nilaisubdimensi.tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
    public function getNilaiIndikatorPerTahun($kode_indikator, $tahun, $status = 0)
    {
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->where('tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        return $result;
    }
    public function getNilaiIndikator($star_date = null, $end_date = null)
    {
        $this->db->select('nilai,kode_indikator,tahun');
        $this->db->from('nilaiindikator');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
    public function getNilaiIndikatorReal($kode_indikator, $tahun = null)
    {
        $this->db->select('nilaiindikator.nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('nilaiindikator.kode_indikator', $kode_indikator);
        if ($tahun != null) {
            $this->db->where('nilaiindikator.tahun', $tahun);
        }
        return $this->db->get()->row_array();
    }
}
