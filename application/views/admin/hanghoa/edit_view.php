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
                <div class="form-group<?php echo (form_error('tenhanghoa')) ? 'has-error' : ''; ?>">
                    <label>Mặt hàng</label>
                    <input type="text" class="form-control" placeholder="Nhập mặt hàng" name="tenhanghoa"
                           value="<?php echo set_value('tenhanghoa', $hanghoa['tenhanghoa']); ?>">
                </div>
                <div class="form-group<?php echo (form_error('dvt')) ? 'has-error' : ''; ?>">
                    <label>Đơn vị tính</label>
                    <input type="text" class="form-control" placeholder="Nhập đơn vị tính" name="dvt"
                           value="<?php echo set_value('dvt', $hanghoa['dvt']); ?>">
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