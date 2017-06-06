<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_nhanvien extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('nhanvien_id, hoten, ngaysinh, gioitinh')
            ->from('nhanvien')
            ->limit($limit, $start)
            ->order_by('nhanvien_id', 'ASC')
            ->get()->result_array();
    }

    public function get_nhanvien($id)
    {
        return $this->db->select('nhanvien_id, hoten, ngaysinh, gioitinh')
            ->from('nhanvien')
            ->where('nhanvien_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('nhanvien', array(
            'hoten' => $this->input->post('hoten'),
            'ngaysinh' => $this->input->post('ngaysinh'),
            'gioitinh' => $this->input->post('gioitinh')
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
        $this->db->delete('nhanvien', array('nhanvien_id' => (int)$id));
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
        $this->db->where_in('nhanvien_id', $checkbox)->delete('nhanvien');
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
        $this->db->where('nhanvien_id', (int)$id)->update('nhanvien', array(
            'hoten' => $this->input->post('hoten'),
            'ngaysinh' => $this->input->post('ngaysinh'),
            'gioitinh' => $this->input->post('gioitinh')
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
        return $this->db->get('nhanvien')->num_rows();
    }
}