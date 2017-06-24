<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Cafe Anh Hòa</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-msg">
        <?php echo validation_errors(); ?>
    </div>
    <?php
    $message_flashdata = $this->session->flashdata('message_flashdata');
    if (isset($message_flashdata) && count($message_flashdata)){
        if ($message_flashdata['type'] == 'success'){
            ?>
            <div class="alert alert-success alert-dismissible"><i class="icon fa fa-check"></i> <?php echo $message_flashdata['message']; ?></div>
            <?php
        }
        else{
            ?>
            <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-phieunhap"></i> <?php echo $message_flashdata['message']; ?></div>
            <?php
        }
    }
    ?>
    <div class="login-box-body">
        <?php
        $att = array('role' => 'form');
        echo form_open('', $att);
        ?>
            <div class="form-group<?php echo (form_error('username')) ? 'has-error' : ''; ?>">
                <input type="text" class="form-control" placeholder="Tài khoản" name="username"
                       value="<?php echo set_value('username', ''); ?>">
            </div>
            <div class="form-group<?php echo (form_error('password')) ? 'has-error' : ''; ?>">
                <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
                       value="<?php echo set_value('password', ''); ?>">
            </div>
            <div class="row">
                <div class="col-xs-6"></div>
                <div class="col-xs-4 pull-right">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        <?php
        echo form_close();
        ?>

        <div class="social-auth-links text-center">
        </div>
        <!-- /.social-auth-links -->


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
