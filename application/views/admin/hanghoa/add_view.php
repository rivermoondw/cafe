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
            $current_url = current_url().'?'.$_SERVER['QUERY_STRING'];
            $att = array('role' => 'form');
            echo form_open($current_url, $att);
            ?>
            <div class="box-body">
                <div class="form-group<?php echo (form_error('tenhanghoa')) ? 'has-error' : ''; ?>">
                    <label>Mặt hàng</label>
                    <input type="text" class="form-control" placeholder="Nhập mặt hàng" name="tenhanghoa"
                           value="<?php echo set_value('tenhanghoa', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('dvt')) ? 'has-error' : ''; ?>">
                    <label>Đơn vị tính</label>
                    <select class="form-control select2" name="dvt" style="width: 100%;">
                        <option value="kg">kg</option>
                        <option value="chiếc">chiếc</option>
                        <option value="lít">lít</option>
                        <option value="khác">khác</option>
                    </select>
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