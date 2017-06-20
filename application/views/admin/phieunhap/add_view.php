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
                <div class="form-group<?php echo (form_error('maphieunhap')) ? 'has-error' : ''; ?>">
                    <label>Mã phiếu nhập</label>
                    <input type="text" class="form-control" placeholder="Nhập mã phiếu nhập" name="maphieunhap"
                           value="<?php echo set_value('maphieunhap', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('ngaynhap')) ? 'has-error' : ''; ?>">
                    <label>Ngày nhập</label>
                    <input type="text" class="form-control" placeholder="Nhập ngày nhập" name="ngaynhap"
                           value="<?php echo set_value('ngaynhap', ''); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
                <div class="form-group">
                    <label>Nhà cung cấp</label>
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