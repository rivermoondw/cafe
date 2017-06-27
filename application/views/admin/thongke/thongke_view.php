<div class="row">
    <?php
    $att = array('role' => 'form');
    echo form_open('', $att);
    ?>
    <div class="col-md-12">
        <div class="box box-solid">
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
                        <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-ban"></i> <?php echo $message_flashdata['message']; ?></div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tháng</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <select class="form-control select2" name="month" style="width: 100%;">
                                    <?php
                                    for ($i=1;$i<=12;$i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Năm</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <select class="form-control select2" name="year" style="width: 100%;">
                                    <?php
                                    $start_year = 1980;
                                    $end_year = date("Y");
                                    for($i=$end_year;$i>=$start_year;$i--) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary btn-sm">
            </div>
        </div>
    </div>
    <?php echo form_close()?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Thống kê tài chính</h3>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Tổng thu</dt>
                    <dd><?php echo isset($tongtien['thanhtien'])?$tongtien['thanhtien']:0; ?></dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Top 10 đồ uống</h3>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Đồ uống</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_douong) && count($list_douong)){
                        foreach ($list_douong as $key => $val){
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($val['douong']); ?></td>
                                <td><?php echo htmlspecialchars($val['count']); ?></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="2">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- left -->
    <div class="col-md-6">
    </div>
</div>