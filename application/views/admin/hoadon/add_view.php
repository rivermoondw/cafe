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
                <div class="form-group<?php echo (form_error('mahoadon')) ? 'has-error' : ''; ?>">
                    <label>Mã hóa đơn</label>
                    <input type="text" class="form-control" name="mahoadon"
                           value="<?php echo set_value('mahoadon', 'HD-'.mdate('%d%m%y%H%i%s',now())); ?>" readonly>
                </div>
                <div class="form-group <?php echo (form_error('ngaylap')) ? 'has-error' : ''; ?>">
                    <label>Ngày lập</label>
                    <input type="text" class="form-control" name="ngaylap"
                           value="<?php echo set_value('ngaylap', mdate('%d/%m/%Y %H:%i:%s',now())); ?>" readonly>
                </div>
                <div class="form-group <?php echo (form_error('nhanvien')) ? 'has-error' : ''; ?>">
                    <label>Nhân viên</label>
                    <input type="text" class="form-control"
                           value="<?php echo set_value('nhanvien', $nhanvien['hoten']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Kiểu đặt</label>
                    <select class="form-control select2" name="kieudat" id="kieudat" style="width: 100%;">
                        <option value="0">Mang về</option>
                        <option value="1">Ăn tại quán</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bàn</label>
                    <select class="form-control select2" name="ban_id[]" id="ban" multiple="multiple" data-placeholder="Nhập bàn" style="width: 100%;">
                        <?php
                        foreach ($list_ban as $key => $val) {
                            echo '<option value="' . $val['ban_id'] . '">' . $val['tenban'] . '</option>';
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
