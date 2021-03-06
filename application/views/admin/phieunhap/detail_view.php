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
                        <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-phieunhap"></i> <?php echo $message_flashdata['message']; ?></div>
                        <?php
                    }
                }
                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Mã phiếu nhập</th>
                        <th>Ngày nhập</th>
                        <th>Nhân viên thực hiện</th>
                        <th>Nhà cung cấp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $phieunhap['maphieunhap']; ?></td>
                        <td><?php echo nice_date($phieunhap['ngaynhap'], 'd/m/Y'); ?></td>
                        <td><?php echo $phieunhap['hoten']; ?></td>
                        <td><?php echo $phieunhap['nhacungcap']; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Chi tiết phiếu nhập</h3>
            </div>
            <div class="box-body">
                <?php
                $att = array('role' => 'form');
                echo form_open('', $att);
                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Hàng hóa</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tongtien = 0;
                    if (isset($list_hanghoa) && count($list_hanghoa)){
                        foreach ($list_hanghoa as $key => $val){
                            $tongtien += $val['dongia']*$val['soluongnhap'];
                            ?>
                            <tr>
                                <td><?php echo $val['tenhanghoa']; ?></td>
                                <td><?php echo $val['soluongnhap']; ?></td>
                                <td><?php echo $val['dongia']; ?></td>
                                <td style="width:10px"><button type="submit" class="btn btn-danger btn-xs" style="color:#fff" name="del" value="<?php echo $val['ctphieunhap_id']; ?>"><i class="fa fa-close"></i></button></td>
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
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Thêm hàng hóa</h3>
                <?php echo validation_errors(); ?>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label>Hàng hóa</label>
                        <select class="form-control select2" name="hanghoa_id" style="width: 100%;">
                            <?php
                            foreach ($hanghoa as $key => $val) {
                                echo '<option value="' . $val['hanghoa_id'] . '">' . $val['tenhanghoa'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-4">
                        <label>Số lượng nhập</label>
                        <input type="text" class="form-control" placeholder="Nhập số lượng nhập" name="soluongnhap"
                               value="<?php echo set_value('soluongnhap', '1'); ?>">
                    </div>
                    <div class="form-group col-xs-4">
                        <label>Đơn giá</label>
                        <input type="text" class="form-control" placeholder="Nhập đơn giá" name="dongia"
                               value="<?php echo set_value('dongia', '0'); ?>">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" value="Thêm vào phiếu nhập" class="btn btn-primary">
                <a href="<?php echo base_url(); ?>admin/hanghoa/add?redirect=<?php echo base64_encode(uri_string()); ?>"><button type="button" class="btn btn-primary btn-default" style="color:#fff"><i class="fa fa-plus"></i> Thêm mặt hàng mới</button></a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>