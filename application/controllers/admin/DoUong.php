<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Douong extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý đồ uống';
        $this->load->model('admin/model_douong');
        $this->load->helper('form');
        $this->data['active_parent'] = 'douong';
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
        $this->data['active'] = 'douong';
        $this->data['content_header'] = 'Danh sách đồ uống';
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
                $flag = $this->model_douong->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/douong');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/douong');
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
        $config['base_url'] = 'http://localhost:8080/cafe/admin/douong/index/';
        $config['total_rows'] = $this->model_douong->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_douong'] = $this->model_douong->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/douong/list_view');
    }

    public function add()
    {
        $this->data['page_title'] = 'Thêm đồ uống';
        $this->data['active'] = 'them_douong';
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
        $this->data['content_header'] = 'Thêm đồ uống';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('douong', 'Tên mặt hàng', 'required|trim|is_unique[douong.douong]', array(
                'is_unique' => '%s đã tồn tại'
            ));
            $this->form_validation->set_rules('dongia', 'Đơn giá', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_douong->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/douong');
            }
        }
        $this->render('admin/douong/add_view');
    }

    public function del($id = 0)
    {
        $douong = $this->model_douong->get_douong($id);
        if (!isset($douong) || count($douong) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Đồ uống không tồn tại'
            ));
            redirect('admin/douong');
        }
        $flag = $this->model_douong->del($douong['douong_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/douong');
    }

    public function edit($id = 0)
    {
        $douong = $this->model_douong->get_douong($id);
        if (!isset($douong) || count($douong) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Đồ uống không tồn tại'
            ));
            redirect('admin/douong');
        }
        $this->data['page_title'] = 'Sửa thông tin đồ uống';
        $this->data['content_header'] = 'Sửa thông tin đồ uống';
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
        $this->data['douong'] = $douong;
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('douong', 'Tên đồ uống', 'required|trim');
            $this->form_validation->set_rules('dongia', 'Đơn giá', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_douong->edit($douong['douong_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/douong');
            }
        }
        $this->render('admin/douong/edit_view');
    }
}