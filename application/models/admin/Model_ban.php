<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ban extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('ban_id, tenban, socho')
            ->from('ban')
            ->limit($limit, $start)
            ->order_by('tenban', 'ASC')
            ->get()->result_array();
    }

    public function get_ban($id)
    {
        return $this->db->select('ban_id, tenban, socho')
            ->from('ban')
            ->where('ban_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('ban', array(
            'tenban' => $this->input->post('tenban'),
            'socho' => $this->input->post('socho')
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
        $this->db->delete('ban', array('ban_id' => (int)$id));
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
        $this->db->where_in('ban_id', $checkbox)->delete('ban');
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
        $this->db->where('ban_id', (int)$id)->update('ban', array(
            'tenban' => $this->input->post('tenban'),
            'socho' => $this->input->post('socho')
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
        return $this->db->get('ban')->num_rows();
    }
}