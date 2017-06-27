<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Thông tin phiếu nhập</h3>
            </div>
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
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Ngày lập</th>
                        <th>Nhân viên</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $hoadon['mahoadon']; ?></td>
                        <td><?php echo nice_date($hoadon['ngaylap'], 'd/m/Y H:i:s'); ?></td>
                        <td><?php echo $hoadon['hoten']; ?></td>
                        <td><?php echo ($hoadon['trangthai']==0)?'Chưa thanh toán':'Đã thanh toán'; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($hoadon['trangthai']==0){
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <?php
                $att = array('role' => 'form');
                echo form_open('', $att);
                ?>
                <input type="submit" name="thanhtoan" value="Thanh toán" class="btn btn-success">
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Chi tiết hóa đơn</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Đồ uống</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <?php
                        if ($hoadon['trangthai']==0){
                        ?>
                        <th></th>
                        <?php
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tongtien = 0;
                    if (isset($list_douong) && count($list_douong)){
                        foreach ($list_douong as $key => $val){
                            $tongtien += $val['dongia']*$val['soluong'];
                            ?>
                            <tr>
                                <td><?php echo $val['douong']; ?></td>
                                <td><?php echo $val['soluong']; ?></td>
                                <td><?php echo $val['dongia']; ?></td>
                                <?php
                                if ($hoadon['trangthai']==0){
                                ?>
                                <td style="width:10px"><button type="submit" class="btn btn-danger btn-xs" style="color:#fff" name="del" value="<?php echo $val['id']; ?>"><i class="fa fa-close"></i></button></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="3">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"><b>Tổng tiền</b></td>
                        <td><b><?php echo $tongtien; ?></b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php
    if ($hoadon['trangthai']==0){
    ?>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Thêm đồ uống</h3>
                <?php echo validation_errors(); ?>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-xs-8">
                        <label>Đồ uống</label>
                        <select class="form-control select2" name="douong_id" style="width: 100%;">
                            <?php
                            foreach ($douong as $key => $val) {
                                echo '<option value="' . $val['douong_id'] . '">' . $val['douong'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-4">
                        <label>Số lượng</label>
                        <input type="text" class="form-control" placeholder="Nhập số lượng" name="soluong"
                               value="<?php echo set_value('soluong', '1'); ?>">
                    </div>
                    <input type="text" hidden name="thanhtien" value="<?php echo $tongtien;?>">
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" value="Thêm vào hóa đơn" class="btn btn-primary">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php
    }
    ?>
</div>