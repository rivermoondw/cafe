<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Trang chủ';
        $this->data['active_parent'] = 'home';
    }

    public function index()
    {
        if ($this->ion_auth->in_group('admin')){
            redirect('admin/nhanvien');
        }
        if ($this->ion_auth->in_group('manager')){
            redirect('admin/phieunhap');
        }
        if ($this->ion_auth->in_group('seller')){
            redirect('admin/ban/status');
        }
    }
}