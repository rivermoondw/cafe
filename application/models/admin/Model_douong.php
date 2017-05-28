<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_douong extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('douong_id, douong, dongia')
            ->from('douong')
            ->limit($limit, $start)
            ->order_by('douong', 'ASC')
            ->get()->result_array();
    }

    public function get_douong($id)
    {
        return $this->db->select('douong_id, douong, dongia')
            ->from('douong')
            ->where('douong_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('douong', array(
            'douong' => $this->input->post('douong'),
            'dongia' => $this->input->post('dongia')
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
        $this->db->delete('douong', array('douong_id' => (int)$id));
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
        $this->db->where_in('douong_id', $checkbox)->delete('douong');
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
        $this->db->where('douong_id', (int)$id)->update('douong', array(
            'douong' => $this->input->post('douong'),
            'dongia' => $this->input->post('dongia')
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
        return $this->db->get('douong')->num_rows();
    }
}