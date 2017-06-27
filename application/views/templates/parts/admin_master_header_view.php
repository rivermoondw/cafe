<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <?php echo $before_head; ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>admin/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><strong>Cafe</strong></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>assets/admin/img/<?php echo $avatar['avatar']; ?>.jpg" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $user_groups[0]->description; ?></p>
                    <p><?php echo $nhanvien['hoten'];?></p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><h5 style="color: #fff">Menu chính</h5></li>
                <?php
                $group = array('seller','admin');
                if ($this->ion_auth->in_group($group)){
                ?>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'tinhtrangban') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/ban/status"><span>Tình trạng bàn</span></a></li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'ban') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Quản lý bàn</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'ban') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/ban"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'ban') ? 'text-aqua' : ''; ?>"></i>Danh sách bàn</a>
                        </li>
                        <li class="<?php echo (isset($active) && $active == 'them_ban') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/ban/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_ban') ? 'text-aqua' : ''; ?>"></i>Thêm bàn</a></li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'douong') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Quản lý đồ uống</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'douong') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/douong"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'room') ? 'text-aqua' : ''; ?>"></i>Danh sách đồ uống</a></li>
                        <li class="<?php echo (isset($active) && $active == 'them_douong') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/douong/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_douong') ? 'text-aqua' : ''; ?>"></i>Thêm đồ uống</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'hoadon') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Hóa đơn</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'hoadon') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/hoadon"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'hoadon') ? 'text-aqua' : ''; ?>"></i>Danh sách hóa đơn</a>
                        </li>
                        <li class="<?php echo (isset($active) && $active == 'them_hoadon') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/hoadon/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_hoadon') ? 'text-aqua' : ''; ?>"></i>Thêm hóa đơn</a></li>
                    </ul>
                </li>
                <?php
                }
                $group = array('manager','admin');
                if ($this->ion_auth->in_group($group)){
                ?>
                    <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'nhacungcap') ? 'active' : ''; ?>">
                        <a href="#">
                            <span>Quản lý nhà cung cấp</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo (isset($active) && $active == 'nhacungcap') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/nhacungcap"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhacungcap') ? 'text-aqua' : ''; ?>"></i>Danh sách nhà cung cấp</a></li>
                            <li class="<?php echo (isset($active) && $active == 'them_nhacungcap') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhacungcap') ? 'text-aqua' : ''; ?>"></i>Thêm nhà cung cấp</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'hanghoa') ? 'active' : ''; ?>">
                        <a href="#">
                            <span>Quản lý hàng hóa</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo (isset($active) && $active == 'hanghoa') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/hanghoa"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'hanghoa') ? 'text-aqua' : ''; ?>"></i>Danh sách hàng hóa</a></li>
                            <li class="<?php echo (isset($active) && $active == 'them_hanghoa') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/hanghoa/add"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_hanghoa') ? 'text-aqua' : ''; ?>"></i>Thêm hàng hóa</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'nhaphang') ? 'active' : ''; ?>">
                        <a href="#">
                            <span>Quản lý nhập hàng</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo (isset($active) && $active == 'nhaphang') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/phieunhap"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhaphang') ? 'text-aqua' : ''; ?>"></i>Danh sách nhập hàng</a></li>
                            <li class="<?php echo (isset($active) && $active == 'them_nhaphang') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/phieunhap/add"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhaphang') ? 'text-aqua' : ''; ?>"></i>Thêm nhập hàng</a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                if ($this->ion_auth->is_admin()){
                ?>
                    <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'nhanvien') ? 'active' : ''; ?>">
                        <a href="#">
                            <span>Quản lý nhân viên</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo (isset($active) && $active == 'nhanvien') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/nhanvien"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhanvien') ? 'text-aqua' : ''; ?>"></i>Danh sách nhân viên</a></li>
                            <li class="<?php echo (isset($active) && $active == 'them_nhanvien') ? 'active' : ''; ?>"><a
                                        href="<?php echo base_url(); ?>admin/nhanvien/add"><i
                                            class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhanvien') ? 'text-aqua' : ''; ?>"></i>Thêm nhân viên</a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'statistic') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/thongke"><span>Thống kê</span></a></li>
                <li><a href="<?php echo base_url(); ?>admin/user/logout"><span>Đăng xuất</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>