<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_thongke extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_tongtien($month, $year){
        return $this->db->select_sum('thanhtien')
            ->where('MONTH(ngaylap)', $month)
            ->where('YEAR(ngaylap)', $year)
            ->get('hoadon')->row_array();
    }

    public function get_douong($month, $year){
        return $this->db->select('douong, COUNT(douong.douong_id) as count')
            ->from('douong')
            ->join('cthoadon', 'cthoadon.douong_id = douong.douong_id')
            ->join('hoadon', 'hoadon.hoadon_id = cthoadon.hoadon_id')
            ->where('MONTH(ngaylap)', $month)
            ->where('YEAR(ngaylap)', $year)
            ->limit(10)
            ->group_by('douong.douong_id')
            ->get()->result_array();
    }

}