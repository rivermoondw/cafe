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
                    <img src="<?php echo base_url(); ?>assets/admin/dist/img/Screenshot_12.png" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Nhân viên</p>
                    <p>Yowzah</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><h5 style="color: #fff">Menu chính</h5></li>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'trangchu') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/home"><span>Trang chủ</span></a></li>
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
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
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
                                    href="<?php echo base_url(); ?>admin/hanghoa"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhaphang') ? 'text-aqua' : ''; ?>"></i>Danh sách nhập hàng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'them_nhaphang') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhaphang') ? 'text-aqua' : ''; ?>"></i>Thêm nhập hàng</a>
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
                                    href="<?php echo base_url(); ?>admin/hanghoa"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhaphang') ? 'text-aqua' : ''; ?>"></i>Danh sách nhập hàng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'them_nhaphang') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhaphang') ? 'text-aqua' : ''; ?>"></i>Thêm nhập hàng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'nhaphang') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Quản lý xuất hàng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'xuathang') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/hanghoa"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'xuathang') ? 'text-aqua' : ''; ?>"></i>Danh sách xuất hàng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'them_xuathang') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_xuathang') ? 'text-aqua' : ''; ?>"></i>Thêm xuất hàng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'nhanvien') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Quản lý nhân viên</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'nhanvien') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/hanghoa"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'nhanvien') ? 'text-aqua' : ''; ?>"></i>Danh sách nhân viên</a></li>
                        <li class="<?php echo (isset($active) && $active == 'them_nhanvien') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_nhanvien') ? 'text-aqua' : ''; ?>"></i>Thêm nhân viên</a>
                        </li>
                        <li class="<?php echo (isset($active) && $active == 'them_taikhoan') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/nhacungcap/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'them_taikhoan') ? 'text-aqua' : ''; ?>"></i>Thêm tài khoản</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'statistic') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/statistic"><span>Thống kê</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>