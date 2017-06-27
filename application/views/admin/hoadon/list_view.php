<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
            <div class="box-body">
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
                <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-hoadon"></i> <?php echo $message_flashdata['message']; ?></div>
                <?php
                    }
                }
                ?>
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                        <th>Mã hóa đơn</th>
                        <th>Ngày lập</th>
                        <th>Nhân viên</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_hoadon) && count($list_hoadon)){
                        foreach ($list_hoadon as $key => $val){
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $val['hoadon_id']; ?>"></td>
                        <td><?php echo htmlspecialchars($val['mahoadon']); ?></td>
                        <td><?php echo nice_date(htmlspecialchars($val['ngaylap']),'d/m/Y H:i:s'); ?></td>
                        <td><?php echo htmlspecialchars($val['hoten']); ?></td>
                        <td><?php echo ($val['trangthai']==0)?'Chưa thanh toán':'Đã thanh toán'; ?></td>
                    </tr>
                    <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="5">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
                <button type="submit" name="btn-delete" value="btn-delete" class="btn btn-default" id="del-list"><i class="fa fa-trash-o"></i> Xóa lựa chọn</button>
                <a href="<?php echo base_url(); ?>admin/hoadon/add"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Thêm hóa đơn</button></a>
                <?php echo isset($pagination)?$pagination:''; ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->