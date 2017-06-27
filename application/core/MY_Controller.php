<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CI_App';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);;
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}

class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/user/login');
        }
        $this->data['page_title'] = 'Trang chủ';

        $this->load->library('ion_auth');
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;
        $this->load->model('admin/model_nhanvien');
        $this->data['nhanvien'] = $this->model_nhanvien->get_nhanvien($user->nhanvien_id);
        $user_groups = $this->ion_auth->get_users_groups()->result();
        $this->data['user_groups'] = $user_groups;
        $this->data['avatar'] = $this->ion_auth->get_avatar($user_groups[0]->id);
    }

    protected function render($the_view = NULL, $template = 'admin_master')
    {
        parent::render($the_view, $template);
    }
}

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}