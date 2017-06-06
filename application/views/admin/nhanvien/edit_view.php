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
                <div class="form-group<?php echo (form_error('hoten')) ? 'has-error' : ''; ?>">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" placeholder="Nhập họ tên" name="hoten"
                           value="<?php echo set_value('hoten', $nhanvien['hoten']); ?>">
                </div>
                <div class="form-group <?php echo (form_error('ngaysinh')) ? 'has-error' : ''; ?>">
                    <label>Ngày sinh</label>
                    <input type="text" class="form-control" placeholder="Nhập ngày sinh" name="ngaysinh"
                           value="<?php echo set_value('ngaysinh', $nhanvien['ngaysinh']); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
                <div class="form-group">
                    <label>Giới tính: </label>
                    <input type="radio" name="gioitinh" value="Nam" class="flat-red" <?php echo ($nhanvien['gioitinh']=='Nam')?'checked':''; ?>>
                    <label>Nam </label>
                    <input type="radio" name="gioitinh" value="Nữ" class="flat-red" <?php echo ($nhanvien['gioitinh']=='Nữ')?'checked':''; ?>>
                    <label>Nữ</label>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary">
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (left) -->
</div>
<!-- /.row -->