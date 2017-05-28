<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_nhacungcap extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('nhacungcap_id, nhacungcap, diachi, sdt')
            ->from('nhacungcap')
            ->limit($limit, $start)
            ->order_by('nhacungcap', 'ASC')
            ->get()->result_array();
    }

    public function get_nhacungcap($id)
    {
        return $this->db->select('nhacungcap_id, nhacungcap, diachi, sdt')
            ->from('nhacungcap')
            ->where('nhacungcap_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('nhacungcap', array(
            'nhacungcap' => $this->input->post('nhacungcap'),
            'diachi' => $this->input->post('diachi'),
            'sdt' => $this->input->post('sdt')
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
        $this->db->delete('nhacungcap', array('nhacungcap_id' => (int)$id));
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
        $this->db->where_in('nhacungcap_id', $checkbox)->delete('nhacungcap');
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
        $this->db->where('nhacungcap_id', (int)$id)->update('nhacungcap', array(
            'nhacungcap' => $this->input->post('nhacungcap'),
            'diachi' => $this->input->post('diachi'),
            'sdt' => $this->input->post('sdt')
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
        return $this->db->get('nhacungcap')->num_rows();
    }
}