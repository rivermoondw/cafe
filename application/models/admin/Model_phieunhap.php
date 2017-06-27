<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_phieunhap extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('phieunhap_id, ngaynhap, nhacungcap, maphieunhap, nhacungcap.nhacungcap_id, hoten')
            ->from('phieunhap')
            ->join('nhacungcap', 'nhacungcap.nhacungcap_id = phieunhap.nhacungcap_id')
            ->join('nhanvien', 'nhanvien.nhanvien_id = phieunhap.nhanvien_id')
            ->limit($limit, $start)
            ->order_by('ngaynhap', 'DESC')
            ->get()->result_array();
    }

    public function get_phieunhap($id)
    {
        return $this->db->select('phieunhap_id, ngaynhap, nhacungcap.nhacungcap_id, maphieunhap, nhacungcap, hoten')
            ->from('phieunhap')
            ->join('nhacungcap', 'nhacungcap.nhacungcap_id = phieunhap.nhacungcap_id')
            ->join('nhanvien', 'nhanvien.nhanvien_id = phieunhap.nhanvien_id')
            ->where('phieunhap_id', (int)$id)
            ->get()->row_array();
    }

    public function get_list_hanghoa($phieunhap_id){
        return $this->db->select('ctphieunhap_id , tenhanghoa, soluongnhap, dongia, hanghoa.hanghoa_id')
            ->from('ctphieunhap')
            ->join('hanghoa', 'hanghoa.hanghoa_id = ctphieunhap.hanghoa_id')
            ->join('phieunhap', 'phieunhap.phieunhap_id = ctphieunhap.phieunhap_id')
            ->where('phieunhap.phieunhap_id', (int)$phieunhap_id)
            ->get()->result_array();
    }

    public function del_hanghoa($ctphieunhap_id){
        $this->db->delete('ctphieunhap', array(
            'ctphieunhap_id' => (int)$ctphieunhap_id
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Xóa dữ liệu thành công'
            );
        } else {
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function add_hanghoa($phieunhap_id){
        $this->db->insert('ctphieunhap', array(
            'phieunhap_id' => $phieunhap_id,
            'hanghoa_id' => $this->input->post('hanghoa_id'),
            'soluongnhap' => $this->input->post('soluongnhap'),
            'dongia' => $this->input->post('dongia')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm hàng hóa thành công',
                'last_id' => $this->db->insert_id()
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi thêm hàng hóa'
            );
        }
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $ngaynhap = str_replace('/', '-', $this->input->post('ngaynhap'));
        $this->db->insert('phieunhap', array(
            'ngaynhap' => date('Y-m-d',strtotime($ngaynhap)),
            'nhacungcap_id' => $this->input->post('nhacungcap_id'),
            'maphieunhap' => $this->input->post('maphieunhap'),
            'nhanvien_id' => $user->nhanvien_id
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
        $this->db->trans_begin();
        $this->db->delete('ctphieunhap', array('phieunhap_id' => (int)$id));
        $this->db->delete('phieunhap', array('phieunhap_id' => (int)$id));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $this->db->trans_commit();
            return array(
                'type' => 'success',
                'message' => 'Xóa dữ liệu thành công'
            );
        } else {
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function del_list($checkbox)
    {
        $this->db->trans_begin();
        $this->db->where_in('phieunhap_id', $checkbox)->delete('ctphieunhap');
        $this->db->where_in('phieunhap_id', $checkbox)->delete('phieunhap');
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $this->db->trans_commit();
            return array(
                'type' => 'success',
                'message' => 'Đã xóa (' . count($checkbox) . ') dữ liệu'
            );
        } else {
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function edit($id)
    {
        $ngaynhap = str_replace('/', '-', $this->input->post('ngaynhap'));
        $this->db->where('phieunhap_id', (int)$id)->update('phieunhap', array(
            'ngaynhap' => date('Y-m-d',strtotime($ngaynhap)),
            'nhacungcap_id' => $this->input->post('nhacungcap_id'),
            'maphieunhap' => $this->input->post('maphieunhap')
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