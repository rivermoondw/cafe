<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Phieunhap extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý phiếu nhập';
        $this->load->model('admin/model_phieunhap');
        $this->load->helper('form');
        $this->data['active_parent'] = 'phieunhap';
        $groups = array('admin','manager');
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
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->data['active'] = 'phieunhap';
        $this->data['content_header'] = 'Danh sách phiếu nhập';
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
                $flag = $this->model_phieunhap->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/phieunhap');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/phieunhap');
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
        $config['base_url'] = 'http://localhost:8080/cafe/admin/phieunhap/index/';
        $config['total_rows'] = $this->model_phieunhap->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_phieunhap'] = $this->model_phieunhap->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/phieunhap/list_view');
    }

    public function add()
    {
        $this->load->helper('date');
        $this->data['page_title'] = 'Thêm phiếu nhập';
        $this->data['active'] = 'them_phieunhap';
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
        $this->data['content_header'] = 'Thêm phiếu nhập';
        $this->load->model('admin/model_nhacungcap');
        $this->data['nhacungcap'] = $this->model_nhacungcap->get_ncc();
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('maphieunhap', 'Mã phiếu nhập', 'required|trim|is_unique[phieunhap.maphieunhap]',array(
                'is_unique' => '%s đã tồn tại'
            ));
            $this->form_validation->set_rules('ngaynhap', 'Ngày nhập', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_phieunhap->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = (isset($flag['last_id']))?'admin/phieunhap/detail'.$flag['last_id']:'admin/phieunhap';
                redirect($url);
            }
        }
        $this->render('admin/phieunhap/add_view');
    }

    public function del($id = 0)
    {
        $phieunhap = $this->model_phieunhap->get_phieunhap($id);
        if (!isset($phieunhap) || count($phieunhap) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phiếu nhập không tồn tại'
            ));
            redirect('admin/phieunhap');
        }
        $flag = $this->model_phieunhap->del($phieunhap['phieunhap_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/phieunhap');
    }

    public function edit($id = 0)
    {
        $phieunhap = $this->model_phieunhap->get_phieunhap($id);
        if (!isset($phieunhap) || count($phieunhap) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phiếu nhập không tồn tại'
            ));
            redirect('admin/phieunhap');
        }
        $this->load->helper('date');
        $this->data['page_title'] = 'Sửa thông tin phiếu nhập';
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
        $this->data['phieunhap'] = $phieunhap;
        $this->load->model('admin/model_nhacungcap');
        $this->data['nhacungcap'] = $this->model_nhacungcap->get_ncc();
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('maphieunhap', 'Mã phiếu nhập', 'required|trim|is_unique[phieunhap.maphieunhap]',array(
                'is_unique' => '%s đã tồn tại'
            ));
            $this->form_validation->set_rules('ngaynhap', 'Ngày nhập', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_phieunhap->edit($phieunhap['phieunhap_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/phieunhap');
            }
        }
        $this->render('admin/phieunhap/edit_view');
    }

    public function detail($phieunhap_id){
        $phieunhap = $this->model_phieunhap->get_phieunhap($phieunhap_id);
        if (!isset($phieunhap) || count($phieunhap) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phiếu nhập không tồn tại'
            ));
            redirect('admin/phieunhap');
        }
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
        $this->data['page_title'] = 'Chi tiết phiếu nhập';
        $this->data['content_header'] = 'Chi tiết phiếu nhập';
        $this->data['phieunhap'] = $phieunhap;
        $list_hanghoa = $this->model_phieunhap->get_list_hanghoa($phieunhap_id);
        $data = array();
        if (isset($list_hanghoa)&&count($list_hanghoa)!=0){
            foreach ($list_hanghoa as $key => $val){
                $data[] = $val['hanghoa_id'];
            }
        }
        $this->data['list_hanghoa'] = $list_hanghoa;
        $this->load->model('admin/model_hanghoa');
        $this->data['hanghoa'] = $this->model_hanghoa->get_list_hanghoa($data);
        $this->load->library('form_validation');
        if ($this->input->post('submit')){
            $this->form_validation->set_rules('soluongnhap', 'Số lượng nhập', 'required|trim');
            $this->form_validation->set_rules('dongia', 'Đơn giá', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE){
                $flag = $this->model_phieunhap->add_hanghoa($phieunhap_id);
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = 'admin/phieunhap/detail/'.$phieunhap_id;
                redirect($url);
            }
        }
        if ($this->input->post('del')){
            $flag = $this->model_phieunhap->del_hanghoa($this->input->post('del'));
            $this->session->set_flashdata('message_flashdata', $flag);
            $url = 'admin/phieunhap/detail/'.$phieunhap_id;
            redirect($url);
        }
        $this->render('admin/phieunhap/detail_view');
    }
}