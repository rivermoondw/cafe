<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ban extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý bàn';
        $this->load->model('admin/model_ban');
        $this->load->helper('form');
        $this->data['active_parent'] = 'ban';
        $groups = array('admin','seller');
        if (!$this->ion_auth->in_group($groups)){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bạn không có quyền truy cập vào trang này'
            ));
            redirect('admin/home');
        }
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'ban';
        $this->data['content_header'] = 'Danh sách bàn';
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
                $flag = $this->model_ban->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/ban');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/ban');
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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/ban/index/';
        $config['total_rows'] = $this->model_ban->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_ban'] = $this->model_ban->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/ban/list_view');
    }

    public function add()
    {
        $this->data['page_title'] = 'Thêm bàn';
        $this->data['active'] = 'them_ban';
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
        $this->data['content_header'] = 'Thêm bàn';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('tenban', 'Tên bàn', 'required|trim');
            $this->form_validation->set_rules('socho', 'Số chỗ', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_ban->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/ban');
            }
        }
        $this->render('admin/ban/add_view');
    }

    public function del($id = 0)
    {
        $ban = $this->model_ban->get_ban($id);
        if (!isset($ban) || count($ban) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bàn không tồn tại'
            ));
            redirect('admin/ban');
        }
        $flag = $this->model_ban->del($ban['ban_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/ban');
    }

    public function edit($id = 0)
    {
        $ban = $this->model_ban->get_ban($id);
        if (!isset($ban) || count($ban) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bàn không tồn tại'
            ));
            redirect('admin/ban');
        }
        $this->data['page_title'] = 'Sửa thông tin bàn';
        $this->data['content_header'] = 'Sửa thông tin bàn';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>';
        $this->data['ban'] = $ban;
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('tenban', 'Tên bàn', 'required|trim');
            $this->form_validation->set_rules('socho', 'Số chỗ', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_ban->edit($ban['ban_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/ban');
            }
        }
        $this->render('admin/ban/edit_view');
    }

    public function status($page = 1){
        $this->data['active_parent'] = 'status';
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->data['content_header'] = 'Trang chủ';
        $this->data['before_head'] = '
<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">
  <style>
	.custom {
		color:#fff;
		color: rgba(255,255,255,0.95);
	}
	.custom:hover {
		color:#fff;
		color: rgba(255,255,255,1);
	}
  </style>';
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
        $config['base_url'] = 'http://localhost:8080/pttk/admin/ban/index/';
        $config['total_rows'] = $this->model_ban->total();
        $config['per_page'] = 12;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_ban'] = $this->model_ban->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/ban/status_view');
    }

    public function detail($ban_id){
        $data = $this->model_ban->get_hoadon($ban_id);
        $url = 'admin/hoadon/detail/'.$data['hoadon_id'];
        redirect($url);
    }
}