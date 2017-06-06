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
                <div class="form-group<?php echo (form_error('phieunhap')) ? 'has-error' : ''; ?>">
                    <label>Đồ uống</label>
                    <input type="text" class="form-control" placeholder="Nhập đồ uống" name="phieunhap"
                           value="<?php echo set_value('phieunhap', $phieunhap['phieunhap']); ?>">
                </div>
                <div class="form-group<?php echo (form_error('nhacungcap_id')) ? 'has-error' : ''; ?>">
                    <label>Đơn giá</label>
                    <select class="form-control select2" name="nhacungcap_id" style="width: 100%;">
                        <?php
                        foreach ($nhacungcap as $key => $val) {
                            echo '<option value="' . $val['nhacungcap_id'] . '">' . $val['nhacungcap'] . '</option>';
                        }
                        ?>
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