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
                <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-douong"></i> <?php echo $message_flashdata['message']; ?></div>
                <?php
                    }
                }
                ?>
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                        <th>Đồ uống</th>
                        <th>Đơn giá</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_douong) && count($list_douong)){
                        foreach ($list_douong as $key => $val){
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $val['douong_id']; ?>"></td>
                        <td><?php echo htmlspecialchars($val['douong']); ?></td>
                        <td><?php echo htmlspecialchars($val['dongia']); ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/douong/edit/<?php echo $val['douong_id']; ?>"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Sửa</button></a>
                            <a href="<?php echo base_url(); ?>admin/douong/del/<?php echo $val['douong_id']; ?>"><button type="button" class="btn btn-default btn-xs del-btn"><i class="fa fa-times"></i> Xóa</button></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
                <button type="submit" name="btn-delete" value="btn-delete" class="btn btn-default" id="del-list"><i class="fa fa-trash-o"></i> Xóa lựa chọn</button>
                <a href="<?php echo base_url(); ?>admin/douong/add"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Thêm đồ uống</button></a>
                <?php echo isset($pagination)?$pagination:''; ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->