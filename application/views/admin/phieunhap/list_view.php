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
                <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-phieunhap"></i> <?php echo $message_flashdata['message']; ?></div>
                <?php
                    }
                }
                ?>
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                        <th>Mã phiếu nhập</th>
                        <th>Ngày nhập</th>
                        <th>Nhà cung cấp</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_phieunhap) && count($list_phieunhap)){
                        foreach ($list_phieunhap as $key => $val){
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $val['phieunhap_id']; ?>"></td>
                        <td><a href="<?php echo base_url() . 'admin/phieunhap/detail/' . $val['phieunhap_id']; ?>" style="color: #333"><?php echo htmlspecialchars($val['maphieunhap']); ?></a></td>
                        <td><a href="<?php echo base_url() . 'admin/phieunhap/detail/' . $val['phieunhap_id']; ?>" style="color: #333"><?php echo nice_date(htmlspecialchars($val['ngaynhap']),'d/m/Y'); ?></a></td>
                        <td><a href="<?php echo base_url() . 'admin/phieunhap/detail/' . $val['phieunhap_id']; ?>" style="color: #333"><?php echo htmlspecialchars($val['nhacungcap']); ?></a></td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/phieunhap/edit/<?php echo $val['phieunhap_id']; ?>"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Sửa</button></a>
                            <a href="<?php echo base_url(); ?>admin/phieunhap/del/<?php echo $val['phieunhap_id']; ?>"><button type="button" class="btn btn-default btn-xs del-btn"><i class="fa fa-times"></i> Xóa</button></a>
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
                <a href="<?php echo base_url(); ?>admin/phieunhap/add"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Thêm phiếu nhập</button></a>
                <?php echo isset($pagination)?$pagination:''; ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->