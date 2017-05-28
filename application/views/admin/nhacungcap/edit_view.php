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
                <div class="form-group<?php echo (form_error('nhacungcap')) ? 'has-error' : ''; ?>">
                    <label>Nhà cung cấp</label>
                    <input type="text" class="form-control" placeholder="Nhập nhà cung cấp" name="nhacungcap"
                           value="<?php echo set_value('nhacungcap', $nhacungcap['nhacungcap']); ?>">
                </div>
                <div class="form-group<?php echo (form_error('diachi')) ? 'has-error' : ''; ?>">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="diachi"
                           value="<?php echo set_value('diachi', $nhacungcap['diachi']); ?>">
                </div>
                <div class="form-group<?php echo (form_error('sdt')) ? 'has-error' : ''; ?>">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="sdt"
                           value="<?php echo set_value('sdt', $nhacungcap['sdt']); ?>">
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