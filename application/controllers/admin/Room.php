<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý phòng';
        $this->load->model('admin/model_room');
        $this->load->helper('form');
        $this->data['active_parent'] = 'room';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'room';
        $this->data['content_header'] = 'Danh sách phòng';
        $this->data['before_head'] = '<!-- DataTables -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/flat/blue.css">';
        $this->data['before_body'] = '<!-- DataTables -->
<script src="' . base_url() . 'assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- iCheck -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<script>
  $(function () {
      $(".del-btn").click(function(){
          if(!confirm ("Bạn có muốn xóa không?")) event.preventDefault();
      });
      $(\'#del-list\').click(function(){
        $("input[name=\'checkbox[]\']").each(function(index){
            if ($(this).is(\':checked\')){
                if(!confirm ("Bạn có muốn xóa lựa chọn không?")) event.preventDefault();
                return false;
            }
        });
      });
      //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $(\'#example2 input[type="checkbox"]\').iCheck({
      checkboxClass: \'icheckbox_flat-blue\',
      radioClass: \'iradio_flat-blue\'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data(\'clicks\');
      if (clicks) {
        //Uncheck all checkboxes
        $("#example2 input[type=\'checkbox\']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass(\'fa-square-o\');
      } else {
        //Check all checkboxes
        $("#example2 input[type=\'checkbox\']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass(\'fa-check-square-o\');
      }
      $(this).data("clicks", !clicks);
    });
  });
</script>';
        if ($this->input->post('btn-delete')){
            $checkbox = $this->input->post('checkbox');
            if (is_array($checkbox)){
                $flag = $this->model_room->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/room');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/room');
            }
        }

        $config['full_tag_open'] = '<ul class="pagination pull-right no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Trang đầu';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Trang cuối';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = 'http://localhost:8080/qlks/admin/room/index/';
        $config['total_rows'] = $this->model_room->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_room'] = $this->model_room->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/room/list_view');
    }

    public function add()
    {
        $this->data['active'] = 'add_room';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
        minimumResultsForSearch: Infinity
    });
  });
</script>';
        $this->data['content_header'] = 'Thêm phòng';
        $this->data['rank'] = $this->model_room->rank_list();
        $this->data['type'] = $this->model_room->type_list();
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('room', 'Tên phòng', 'required|trim');
            $this->form_validation->set_rules('tel', 'Số điện thoại', 'required|trim');
            $this->form_validation->set_rules('price', 'Giá phòng', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/room/add_view');
            }
            else{
                $flag = $this->model_room->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/room');
            }
        }
        $this->render('admin/room/add_view');
    }

    public function del($id = 0)
    {
        $room = $this->model_room->get_room($id);
        if (!isset($room) || count($room) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phòng không tồn tại'
            ));
            redirect('admin/room');
        }
        $flag = $this->model_room->del($room['room_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/room');
    }

    public function edit($id = 0)
    {
        $this->data['content_header'] = 'Sửa phòng';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
        minimumResultsForSearch: Infinity
    });
  });
</script>';
        $this->data['rank'] = $this->model_room->rank_list();
        $this->data['type'] = $this->model_room->type_list();
        $room = $this->model_room->get_room($id);
        $this->data['room'] = $room;
        if (!isset($room) || count($room) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phòng không tồn tại'
            ));
            redirect('admin/room');
        }
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('room', 'Tên phòng', 'required|trim');
            $this->form_validation->set_rules('tel', 'Số điện thoại', 'required|trim');
            $this->form_validation->set_rules('price', 'Giá phòng', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/room/edit_view');
            }
            else{
                $flag = $this->model_room->edit($room['room_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/room');

            }
        }
        $this->render('admin/room/edit_view');
    }
}