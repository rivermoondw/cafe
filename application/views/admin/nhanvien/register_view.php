<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Ngày sinh</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $nhanvien['manhanvien']; ?></td>
                    <td><?php echo $nhanvien['hoten']; ?></td>
                    <td><?php echo nice_date($nhanvien['ngaysinh'], 'd/m/Y'); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php echo validation_errors(); ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
            <div class="box-body">
                <div class="form-group<?php echo (form_error('username')) ? 'has-error' : ''; ?>">
                    <label>Tên đăng nhập</label>
                    <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username"
                           value="<?php echo set_value('username', ''); ?>">
                </div>
                <div class="form-group<?php echo (form_error('password')) ? 'has-error' : ''; ?>">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
                           value="<?php echo set_value('password', ''); ?>">
                </div>
                <div class="form-group<?php echo (form_error('email')) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email"
                           value="<?php echo set_value('email', ''); ?>">
                </div>
                <div class="form-group">
                    <label>Chức vụ</label>
                    <select class="form-control select2" name="group" data-placeholder="" style="width: 100%;">
                        <option value="1">Admin</option>
                        <option value="3">Quản lý nhập hàng</option>
                        <option value="4">Quản lý bán hàng</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" name="submit" value="Đăng ký" class="btn btn-primary">
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (left) -->
</div>
<!-- /.row -->