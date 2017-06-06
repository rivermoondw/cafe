<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_phieunhap extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('phieunhap_id, ngaynhap, nhacungcap_id, nhanvien_id')
            ->from('phieunhap')
            ->limit($limit, $start)
            ->order_by('ngaynhap', 'DESC')
            ->get()->result_array();
    }

    public function get_phieunhap($id)
    {
        return $this->db->select('phieunhap_id, ngaynhap, nhacungcap_id, nhanvien_id')
            ->from('phieunhap')
            ->where('phieunhap_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('phieunhap', array(
            'ngaynhap' => $this->input->post('ngaynhap'),
            'nhacungcap_id' => $this->input->post('nhacungcap_id'),
            'nhanvien_id' => $this->input->post('nhanvien_id')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi thêm dữ liệu'
            );
        }
    }

    public function del($id)
    {
        $this->db->delete('phieunhap', array('phieunhap_id' => (int)$id));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Xóa dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function del_list($checkbox)
    {
        $this->db->where_in('phieunhap_id', $checkbox)->delete('phieunhap');
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Đã xóa (' . count($checkbox) . ') dữ liệu'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function edit($id)
    {
        $this->db->where('phieunhap_id', (int)$id)->update('phieunhap', array(
            'ngaynhap' => $this->input->post('ngaynhap'),
            'nhacungcap_id' => $this->input->post('nhacungcap_id'),
            'nhanvien_id' => $this->input->post('nhanvien_id')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Cập nhật dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi cập nhật dữ liệu'
            );
        }
    }

    public function total()
    {
        return $this->db->get('phieunhap')->num_rows();
    }
}