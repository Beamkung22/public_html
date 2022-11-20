<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>ค่าตายตัว </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form method="post">
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                        <select name="typeConfig" class="form-control">
                            <option value="">กรุณาเลือกค่าตายตัว..</option>
                            <?php 
                              $sqlstatusConfig=" select lc.lotto_type from lotto_config lc where 1 group by lotto_type";
                              $rsdstatusConfig=$cls_conn->select_base($sqlstatusConfig);
                              while($statusConfig=mysqli_fetch_array($rsdstatusConfig))
                                { 
                              ?>
                            <option value="<?php echo $statusConfig['lotto_type']; ?>">
                                <?php echo $change_language->change_Config_Type($statusConfig['lotto_type']); ?>
                            </option>
                            <?php 
                                }
                              ?>
                            <option value="Class">ระดับบุคคล</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:5%;">
                        <button type="submit" class="btn btn-round btn-info">ค้นหา</button>
                    </div>
                </form>
                <hr>
                <div id="showDatalist">
                </div>
                <?php 
                  $numPop = 0;
                  if(isset($_POST['typeConfig']) && $_POST['typeConfig'] != ''){
                      $typeConfig = $_POST['typeConfig'];
                      if($typeConfig != "Class"){
                    $sqlstatus=" select lc.lotto_name status 
                        from 
                        lotto_config lc
                        where 
                        lc.lotto_type = '$typeConfig' ";
                        $rsdstatus=$cls_conn->select_base($sqlstatus);
                        $status=mysqli_fetch_array($rsdstatus);
                  ?>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ประเภท</th>
                            <th>ชื่อ</th>
                            <th>Val1</th>
                            <th>Val2</th>
                            <th>Val3</th>
                            <th>Val4</th>
                            <th>Val5</th>
                            <th>คำอธิบาย</th>
                            <th>ActiveFlg</th>
                            <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sqld=" select lc.* 
                        from 
                        lotto_config lc
                        where 
                        lc.lotto_type = '$typeConfig' ";
                        $rsd=$cls_conn->select_base($sqld);
                        while($config=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                            <td><?php echo $change_language->change_Config_Type($config['lotto_type']); ?></td>
                            <td><?php echo $config['lotto_name']; ?></td>
                            <td><?php echo $config['lotto_val1']; ?></td>
                            <td><?php echo $config['lotto_val2']; ?></td>
                            <td><?php echo $config['lotto_val3']; ?></td>
                            <td><?php echo $config['lotto_val4']; ?></td>
                            <td><?php echo $config['lotto_val5']; ?></td>
                            <td><?php echo $config['description']; ?></td>
                            <td><?php echo $config['active_flg']; ?></td>
                            <td><a onclick="editConfig('<?php echo $config['row_id']; ?>')"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php 
                       }
                        ?>
                    </tbody>
                </table>
                <?php 
                  }else{
                    $sqlstatus=" select lc.lotto_name status 
                        from 
                        lotto_config lc
                        where 
                        lc.lotto_type = '$typeConfig' ";
                        $rsdstatus=$cls_conn->select_base($sqlstatus);
                        $status=mysqli_fetch_array($rsdstatus);
                    ?>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ประเภท</th>
                            <th>ชื่อ</th>
                            <th>เปอร์เซน</th>
                            <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sqld=" select c.* 
                        from 
                        class c ";
                        $rsd=$cls_conn->select_base($sqld);
                        while($config=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                            <td><?php echo "ระดับบุคคล"; ?></td>
                            <td><?php echo $config['name']; ?></td>
                            <td><?php echo $config['grossProfit']; ?></td>
                            <td><a onclick="editClass('<?php echo $config['row_id']; ?>')"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php 
                       }
                        ?>
                    </tbody>
                </table>
                <?php
                  }
                }
                    ?>
            </div>
        </div>
    </div>
</div>

<div id="myModalEdit" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขค่าตายตัว</h5>
                <text>ประเภท </text><?php echo $change_language->change_Config_Type($_POST['typeConfig']); ?>
                <br><text>ชื่อ </text><text id="lottoname" />
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <br>
            <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Val1
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lotto_val1" name="lotto_val1"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Val2
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lotto_val2" name="lotto_val2"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Val3
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lotto_val3" name="lotto_val3"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Val4
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lotto_val4" name="lotto_val4"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Val5
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="lotto_val5" name="lotto_val5"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ActiveFlg<span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="activeconfig" name="activeconfig" class="form-control" required>
                                <option value="">กรุณาเลือกสถานะ..</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ออกจากเมนู</button>
                <button type="button" onclick="submitEditConfig()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="myModalEditClass" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขค่าตายตัว</h5>
                <text>ประเภท </text><?php echo "ระดับบุคคล"; ?>
                <br><text>ชื่อ </text><text id="lottoname" />
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <br>
            <div class="modal-body">
                <form method="post" id="editClassGross" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">ระดับ
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="grossProfit" name="grossProfit"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ออกจากเมนู</button>
                <button type="button" onclick="submitEditClass()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
//Edit Config
var rowIdlotto = '';

function editClass(rowId) {
    $.ajax({
        url: "../functions/config_lotto/class_edit_lotto.php",
        method: "POST",
        data: "configid=" + rowId,
        success: function(data) {
            var res = data.split("|");
            rowIdlotto = res[0];
            var lottoName = res[1];

            $(".modal-body #grossProfit").val(res[2]);

            editactive(res[7]);
            $('#lottoname').html(lottoName);
            $("#myModalEditClass").modal('show');
        }
    })


}

function editConfig(rowId) {
    $.ajax({
        url: "../functions/config_lotto/config_edit_lotto.php",
        method: "POST",
        data: "configid=" + rowId,
        success: function(data) {
            var res = data.split("|");
            rowIdlotto = res[0];
            var lottoName = res[1];

            $(".modal-body #lotto_val1").val(res[2]);
            $(".modal-body #lotto_val2").val(res[3]);
            $(".modal-body #lotto_val3").val(res[4]);
            $(".modal-body #lotto_val4").val(res[5]);
            $(".modal-body #lotto_val5").val(res[6]);

            editactive(res[7]);
            $('#lottoname').html(lottoName);
            $("#myModalEdit").modal('show');
        }
    })


}

function editactive(oldactive) {
    $.ajax({
        type: 'POST',
        data: "oldflg=" + oldactive,
        url: '../functions/config_lotto/edit_activeflg.php',
        success: function(data) {
            $('#activeconfig').html(data);
        }
    });
}

function submitEditConfig() {
    if (confirm("คุณต้องการจะบันทึกค่าใช่หรือไม่")) {
        $.ajax({
            url: "../functions/config_lotto/submit_manage_config.php",
            method: "POST",
            data: "configid=" + rowIdlotto +
                "&lotto_val1=" + document.getElementById("lotto_val1").value +
                "&lotto_val2=" + document.getElementById("lotto_val2").value +
                "&lotto_val3=" + document.getElementById("lotto_val3").value +
                "&lotto_val4=" + document.getElementById("lotto_val4").value +
                "&lotto_val5=" + document.getElementById("lotto_val5").value +
                "&active_flg=" + document.getElementById("activeconfig").value,
            success: function(data) {
                $("#myModalEdit").modal('toggle');
                location.reload();
            }
        })
    }
}

function submitEditClass() {
    if (confirm("คุณต้องการจะบันทึกค่าใช่หรือไม่")) {
        $.ajax({
            url: "../functions/config_lotto/submit_manage_class.php",
            method: "POST",
            data: "configid=" + rowIdlotto +
                "&grossProfit=" + document.getElementById("grossProfit").value,
            success: function(data) {
                $("#myModalEditClass").modal('toggle');
                location.reload();
            }
        })
    }
}
</script>