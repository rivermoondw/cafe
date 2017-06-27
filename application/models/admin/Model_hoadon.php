<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_hoadon extends CI_Model
{
    protected $user;
    function __construct()
    {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('hoadon_id, mahoadon, ngaylap, nhanvien.nhanvien_id, thanhtien, trangthai, hoten')
            ->from('hoadon')
            ->join('nhanvien', 'nhanvien.nhanvien_id = hoadon.nhanvien_id')
            ->limit($limit, $start)
            ->order_by('trangthai', 'ASC')
            ->order_by('ngaylap', 'DESC')
            ->get()->result_array();
    }

    public function get_list_douong($data = NULL)
    {
        $this->db->select('douong_id, douong, dongia')
            ->from('douong');
        if (isset($data)&&count($data)){
            $this->db->where_not_in('douong_id',$data);
        }
        return    $this->db->get()->result_array();
    }

    public function get_douong($hoadon_id){
        return $this->db->select('douong.douong_id, douong, soluong, dongia, id')
            ->from('cthoadon')
            ->join('douong', 'douong.douong_id = cthoadon.douong_id')
            ->where('hoadon_id', $hoadon_id)
            ->get()->result_array();
    }

    public function del_douong($id){
        $this->db->delete('cthoadon', array(
            'id' => (int)$id
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

    public function get_hoadon($id)
    {
        return $this->db->select('hoadon_id, mahoadon, ngaylap, nhanvien.nhanvien_id, thanhtien, trangthai, hoten')
            ->from('hoadon')
            ->join('nhanvien', 'nhanvien.nhanvien_id = hoadon.nhanvien_id')
            ->where('hoadon_id', (int)$id)
            ->get()->row_array();
    }

    public function add_douong($hoadon_id){
        $this->db->insert('cthoadon', array(
            'hoadon_id' => $hoadon_id,
            'douong_id' => $this->input->post('douong_id'),
            'soluong' => $this->input->post('soluong')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi'
            );
        }
    }

    public function get_list_ban($hoadon_id){
        return $this->db->select('ban_id')
            ->from('hoadon_ban')
            ->where('hoadon_id', $hoadon_id)
            ->get()->result_array();
    }

    public function thanhtoan($hoadon_id, $data = NULL){
        $this->db->trans_begin();
        if (isset($data)&&count($data)!=0){
            $this->db->where_in('ban_id', $data)->update('ban', array(
                'trangthai' => 0
            ));
        }
        $this->db->where('hoadon_id', (int)$hoadon_id)->update('hoadon', array(
            'trangthai' => 1,
            'thanhtien' => $this->input->post('thanhtien')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $this->db->trans_commit();
            return array(
                'type' => 'success',
                'message' => 'Cập nhật dữ liệu thành công'
            );
        } else {
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi cập nhật dữ liệu'
            );
        }
    }

    public function add()
    {
        $list_ban = $this->input->post('ban_id');
        $ngaylap = str_replace('/', '-', $this->input->post('ngaylap'));
        $this->db->trans_begin();
        $this->db->insert('hoadon', array(
            'mahoadon' => $this->input->post('mahoadon'),
            'ngaylap' => date('Y-m-d H:i:s',strtotime($ngaylap)),
            'trangthai' => 0,
            'nhanvien_id' => (int)$this->user->nhanvien_id
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $last_id = $this->db->insert_id();
            if (isset($list_ban)&&count($list_ban)!=0){
                $data = array();
                foreach ($list_ban as $key => $val){
                    array_push($data, array(
                        'ban_id' => (int)$val,
                        'hoadon_id' => (int)$last_id
                    ));
                }
                $this->db->insert_batch('hoadon_ban', $data);
                $this->db->where_in('ban_id', $list_ban)->update('ban', array(
                    'trangthai' => 1
                ));
                $flag = $this->db->affected_rows();
                if ($flag <= 0){
                    $this->db->trans_rollback();
                    return array(
                        'type' => 'error',
                        'message' => 'Lỗi thêm dữ liệu'
                    );
                }
            }
            $this->db->trans_commit();
            return array(
                'type' => 'success',
                'message' => 'Thêm dữ liệu thành công',
                'last_id' => $last_id
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
        $this->db->delete('hoadon', array('hoadon_id' => (int)$id));
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
        $this->db->where_in('hoadon_id', $checkbox)->delete('hoadon');
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

    public function get_ban_trong(){
        return $this->db->select('ban_id, tenban')
            ->from('ban')
            ->where('trangthai', 0)
            ->order_by('tenban', 'ASC')
            ->get()->result_array();
    }

    public function edit($id)
    {
        $this->db->where('hoadon_id', (int)$id)->update('hoadon', array(
            'mahoadon' => $this->input->post('mahoadon'),
            'ngaylap' => $this->input->post('ngaylap')
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
        return $this->db->get('hoadon')->num_rows();
    }
}