<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index(){
        echo 'user index';
    }

    public function login(){
        $this->data['page_title'] = 'Đăng nhập';
        if ($this->input->post('submit')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Tài khoản', 'required');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE){
                if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'))){
                    redirect('admin/ban');
                }
                else{
                    $flag = array(
                        'type' => 'error',
                        'message' => 'Tài khoản hoặc mật khẩu không đúng'
                    );
                    $this->session->set_flashdata('message_flashdata', $flag);
                    redirect('admin/user/login');
                }
            }
        }
        $this->load->helper('form');
        $this->load->view('admin/login_view');
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect('admin/user/login','refresh');
    }
}