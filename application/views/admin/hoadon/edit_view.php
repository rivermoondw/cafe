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
                <div class="form-group<?php echo (form_error('tenban')) ? 'has-error' : ''; ?>">
                    <label>Tên bàn</label>
                    <input type="text" class="form-control" placeholder="Nhập tên bàn" name="tenban"
                           value="<?php echo set_value('tenban', $ban['tenban']); ?>">
                </div>
                <div class="form-group<?php echo (form_error('socho')) ? 'has-error' : ''; ?>">
                    <label>Số chỗ</label>
                    <input type="text" class="form-control" placeholder="Nhập số chỗ" name="socho"
                           value="<?php echo set_value('socho', $ban['socho']); ?>">
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