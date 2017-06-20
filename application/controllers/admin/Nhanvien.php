<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nhanvien extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý nhân viên';
        $this->load->model('admin/model_nhanvien');
        $this->load->helper('form');
        $this->data['active_parent'] = 'nhanvien';
    }

    public function index($page = 1)
    {
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->data['active'] = 'nhanvien';
        $this->data['content_header'] = 'Danh sách nhân viên';
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
                $flag = $this->model_nhanvien->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/nhanvien');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/nhanvien');
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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/nhanvien/index/';
        $config['total_rows'] = $this->model_nhanvien->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_nhanvien'] = $this->model_nhanvien->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/nhanvien/list_view');
    }

    public function add()
    {
        $this->data['page_title'] = 'Thêm nhân viên';
        $this->data['active'] = 'them_nhanvien';
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
        $this->data['content_header'] = 'Thêm nhân viên';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('hoten', 'Họ tên', 'required|trim');
            $this->form_validation->set_rules('ngaysinh', 'Ngày sinh', 'required|trim');
            $this->form_validation->set_rules('gioitinh', 'Giới tính', 'required|trim');
            $this->form_validation->set_rules('diachi', 'Địa chỉ', 'required|trim');
            $this->form_validation->set_rules('ngaylamviec', 'Ngày vào làm', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_nhanvien->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/nhanvien');
            }
        }
        $this->render('admin/nhanvien/add_view');
    }

    public function del($id = 0)
    {
        $nhanvien = $this->model_nhanvien->get_nhanvien($id);
        if (!isset($nhanvien) || count($nhanvien) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Nhân viên không tồn tại'
            ));
            redirect('admin/nhanvien');
        }
        $flag = $this->model_nhanvien->del($nhanvien['nhanvien_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/nhanvien');
    }

    public function edit($id = 0)
    {
        $nhanvien = $this->model_nhanvien->get_nhanvien($id);
        if (!isset($nhanvien) || count($nhanvien) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Nhân viên không tồn tại'
            ));
            redirect('admin/nhanvien');
        }
        $this->load->helper('date');
        $this->data['page_title'] = 'Sửa thông tin nhân viên';
        $this->data['content_header'] = 'Sửa thông tin nhân viên';
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
        $this->data['nhanvien'] = $nhanvien;
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('hoten', 'Họ tên', 'required|trim');
            $this->form_validation->set_rules('ngaysinh', 'Ngày sinh', 'required|trim');
            $this->form_validation->set_rules('gioitinh', 'Giới tính', 'required|trim');
            $this->form_validation->set_rules('diachi', 'Địa chỉ', 'required|trim');
            $this->form_validation->set_rules('ngaylamviec', 'Ngày vào làm', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_nhanvien->edit($nhanvien['nhanvien_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/nhanvien');
            }
        }
        $this->render('admin/nhanvien/edit_view');
    }
}