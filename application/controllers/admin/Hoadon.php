<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hoadon extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý hóa đơn';
        $this->load->model('admin/model_hoadon');
        $this->load->helper('form');
        $this->data['active_parent'] = 'hoadon';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'hoadon';
        $this->data['content_header'] = 'Danh sách hóa đơn';
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
                $flag = $this->model_hoadon->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/hoadon');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/hoadon');
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
        $config['base_url'] = 'http://localhost:8080/pttk/admin/hoadon/index/';
        $config['total_rows'] = $this->model_hoadon->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_hoadon'] = $this->model_hoadon->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/hoadon/list_view');
    }

    public function add()
    {
        $this->load->helper('string');
        $this->data['page_title'] = 'Thêm hóa đơn';
        $this->data['active'] = 'them_hoadon';
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
    $("#ban").attr("disabled", true);
    $("#kieudat").change(function(){
            if ($(this).val()==0){
                $("#ban").attr("disabled", true);
            }
            else{
                $("#ban").attr("disabled", false);
            }
        });
  });
</script>';
        $this->data['list_ban'] = $this->model_hoadon->get_ban_trong();
        $this->data['content_header'] = 'Thêm hóa đơn';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $flag = $this->model_hoadon->add();
            $this->session->set_flashdata('message_flashdata', $flag);
            redirect('admin/hoadon');
        }
        $this->render('admin/hoadon/add_view');
    }

    public function del($id = 0)
    {
        $hoadon = $this->model_hoadon->get_hoadon($id);
        if (!isset($hoadon) || count($hoadon) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bàn không tồn tại'
            ));
            redirect('admin/hoadon');
        }
        $flag = $this->model_hoadon->del($hoadon['hoadon_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/hoadon');
    }

    public function edit($id = 0)
    {
        $hoadon = $this->model_hoadon->get_hoadon($id);
        if (!isset($hoadon) || count($hoadon) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bàn không tồn tại'
            ));
            redirect('admin/hoadon');
        }
        $this->data['page_title'] = 'Sửa thông tin hóa đơn';
        $this->data['content_header'] = 'Sửa thông tin hóa đơn';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>';
        $this->data['hoadon'] = $hoadon;
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('tenhoadon', 'Tên hóa đơn', 'required|trim');
            $this->form_validation->set_rules('socho', 'Số chỗ', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_hoadon->edit($hoadon['hoadon_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/hoadon');
            }
        }
        $this->render('admin/hoadon/edit_view');
    }

    public function detail($hoadon_id){
        $hoadon = $this->model_hoadon->get_hoadon($hoadon_id);
        if (!isset($hoadon) || count($hoadon) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Bàn không tồn tại'
            ));
            redirect('admin/hoadon');
        }
        $this->data['page_title'] = 'Chi tiết hóa đơn';
        $this->data['content_header'] = 'Chi tiết hóa đơn';
        $this->data['before_head'] = '<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- InputMask -->
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
    //Flat red color scheme for iCheck
    $(\'input[type="checkbox"].flat-red, input[type="radio"].flat-red\').iCheck({
      checkboxClass: \'icheckbox_flat-green\',
      radioClass: \'iradio_flat-green\'
    });
  });
</script>';
        $this->load->helper('date');
        $this->data['hoadon'] = $hoadon;
        $this->data['list_douong'] = $this->model_hoadon->get_douong($hoadon_id);
        $this->data['douong'] = $this->model_hoadon->get_list_douong();
        $this->load->library('form_validation');
        if ($this->input->post('submit')){
            $this->form_validation->set_rules('soluong', 'Số lượng nhập', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE){
                $flag = $this->model_hoadon->add_douong($hoadon_id);
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = 'admin/hoadon/detail/'.$hoadon_id;
                redirect($url);
            }
        }
        if ($this->input->post('thanhtoan')){
            $flag = $this->model_hoadon->thanhtoan($hoadon_id);
            $this->session->set_flashdata('message_flashdata', $flag);
            redirect('admin/hoadon');
        }
        $this->render('admin/hoadon/detail_view');
    }
}