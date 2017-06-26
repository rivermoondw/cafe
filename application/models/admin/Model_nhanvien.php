<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_nhanvien extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('nhanvien_id, hoten, ngaysinh, gioitinh, diachi, ngaylamviec, manhanvien')
            ->from('nhanvien')
            ->limit($limit, $start)
            ->order_by('nhanvien_id', 'ASC')
            ->get()->result_array();
    }

    public function get_nhanvien($id)
    {
        return $this->db->select('nhanvien_id, hoten, ngaysinh, gioitinh, diachi, ngaylamviec, manhanvien')
            ->from('nhanvien')
            ->where('nhanvien_id', (int)$id)
            ->get()->row_array();
    }

    public function get_taikhoan(){
        return $this->db->distinct()->select('nhanvien.nhanvien_id')
            ->from('nhanvien')
            ->join('users', 'users.nhanvien_id = nhanvien.nhanvien_id')
            ->get()->result_array();
    }

    public function add()
    {
        $ngaysinh = str_replace('/', '-', $this->input->post('ngaysinh'));
        $ngaylamviec  = str_replace('/', '-', $this->input->post('ngaylamviec'));
        $this->db->insert('nhanvien', array(
            'manhanvien' => $this->input->post('manhanvien'),
            'hoten' => $this->input->post('hoten'),
            'ngaysinh' => date('Y-m-d',strtotime($ngaysinh)),
            'gioitinh' => $this->input->post('gioitinh'),
            'diachi' => $this->input->post('diachi'),
            'ngaylamviec' => date('Y-m-d',strtotime($ngaylamviec))
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
        $ngaysinh = str_replace('/', '-', $this->input->post('ngaysinh'));
        $ngaylamviec  = str_replace('/', '-', $this->input->post('ngaylamviec'));
        $this->db->where('nhanvien_id', (int)$id)->update('nhanvien', array(
            'manhanvien' => $this->input->post('manhanvien'),
            'hoten' => $this->input->post('hoten'),
            'ngaysinh' => date('Y-m-d',strtotime($ngaysinh)),
            'gioitinh' => $this->input->post('gioitinh'),
            'diachi' => $this->input->post('diachi'),
            'ngaylamviec' => date('Y-m-d',strtotime($ngaylamviec))
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