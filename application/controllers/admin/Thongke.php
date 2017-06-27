<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Thongke extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Thống kê';
        $this->load->model('admin/model_thongke');
        $this->load->helper('form');
        $this->data['active_parent'] = 'thongke';
    }

    public function index(){
        $this->data['content_header'] = 'Thống kê';
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
        if ($this->input->post('submit')){
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $this->data['tongtien'] = $this->model_thongke->get_tongtien($month, $year);
            $this->data['list_douong'] = $this->model_thongke->get_douong($month, $year);
        }
        $this->render('admin/thongke/thongke_view');
    }
}