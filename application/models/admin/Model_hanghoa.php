<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_hanghoa extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('hanghoa_id, tenhanghoa, dvt')
            ->from('hanghoa')
            ->limit($limit, $start)
            ->order_by('tenhanghoa', 'ASC')
            ->get()->result_array();
    }

    public function get_hanghoa($id)
    {
        return $this->db->select('hanghoa_id, tenhanghoa, dvt')
            ->from('hanghoa')
            ->where('hanghoa_id', (int)$id)
            ->get()->row_array();
    }

    public function get_list_hanghoa(){
        return $this->db->select('hanghoa_id, tenhanghoa')
            ->from('hanghoa')
            ->get()->result_array();
    }

    public function add()
    {
        $this->db->insert('hanghoa', array(
            'tenhanghoa' => $this->input->post('tenhanghoa'),
            'dvt' => $this->input->post('dvt')
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
        $this->db->delete('hanghoa', array('hanghoa_id' => (int)$id));
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
        $this->db->where_in('hanghoa_id', $checkbox)->delete('hanghoa');
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
        $this->db->where('hanghoa_id', (int)$id)->update('hanghoa', array(
            'tenhanghoa' => $this->input->post('tenhanghoa'),
            'dvt' => $this->input->post('dvt')
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
        return $this->db->get('hanghoa')->num_rows();
    }
}