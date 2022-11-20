<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ระดับ <text id="typeclass"></text></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cloud-download"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#" onclick="addClass()">เพิ่มระดับ</a>
                          </li>
                          <li><a href="#" onclick="showClass()">ตรวจสอบระดับ</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php 
                  if(isset($_SESSION['rowIdMember']) && $_SESSION['rowIdMember'] != '' && count($_SESSION['rowIdMember']) > 0){
                    unset($_SESSION['rowIdMember']);
                  }
                  ?>
                  <form method="post">
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="statusMenber" class="form-control">
                              <option value="">กรุณาเลือกตำแหน่งของบุคคลากร..</option>
                              <?php 
                              $sqlstatusMe=" select lc.* from lotto_config lc where lc.lotto_type = 'status_user'";
                              $rsdstatusMe=$cls_conn->select_base($sqlstatusMe);
                              while($statusMe=mysqli_fetch_array($rsdstatusMe))
                                { 
                              ?>
                              <option value="<?php echo $statusMe['row_id']; ?>"><?php echo $change_language->change_Status_member($statusMe['lotto_name']); ?></option>
                              <?php 
                                }
                              ?>
                            </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="classMember" class="form-control">
                              <option value="">กรุณาเลือกระดับ..</option>
                              <?php 
                              $sqlclass=" select c.* from class c ";
                              $rsdclass=$cls_conn->select_base($sqlclass);
                              while($class=mysqli_fetch_array($rsdclass))
                                { 
                              ?>
                              <option value="<?php echo $class['row_id']; ?>"><?php echo $class['name']; ?></option>
                              <?php 
                                }
                              ?>
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
                  if(isset($_POST['statusMenber']) && $_POST['statusMenber'] != ''
                  || isset($_POST['classMember']) && $_POST['classMember'] != ''){
                    $rowIdStatus = $_POST['statusMenber'];
                    $classMember = $_POST['classMember'];
                  ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <td>เลือก</td>
                          <th>ชื่อนามสกุล</th>
                          <th>สถานะ</th>
                          <th>เบอร์โทร</th>
                          <th>อีเมล์</th>
                          <th>จำนวนเงิน</th>
                          <th>ระดับ</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sqld=" select m.row_id memberid ,
                        m.name,
                        m.tel,
                        m.Email,
                        m.credit,
                        lc.lotto_name status , 
                        m.status statusid ,
                        m.class classid ,
                        c.name class
                        from 
                        member m, 
                        lotto_config lc,
                        class c
                        where 
                        m.status = lc.row_id
                        and m.class = c.row_id  ";
                        if(isset($rowIdStatus) && $rowIdStatus != ''){
                         $sqld.=" and m.status = '$rowIdStatus'  ";
                        }
                        if(isset($classMember) && $classMember != ''){
                         $sqld.=" and c.row_id = '$classMember'  ";
                        }
                        $rsd=$cls_conn->select_base($sqld);
                        while($member=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><input type="checkbox" id="rowIdMember" value="<?php echo $member['memberid']; ?>" onclick="oncheckUpdate(this,'<?php echo $member['class']; ?>')" ></td>
                          <td><?php echo $member['name']; ?></td>
                          <td><?php echo $change_language->change_Status_member($member['status']); ?></td>
                          <td><?php echo $member['tel']; ?></td>
                          <td><?php echo $member['Email']; ?></td>
                          <td><?php echo number_format($member['credit'])." ฿"; ?></td>
                          <td><?php echo $member['class']; ?></td>
                        </tr>
                        <?php 
                       }
                        ?>
                      </tbody>
                    </table>
                    <div id="showlistUpdate" style="width:50%;"></div>
                    <?php 
                  }
                    ?>
                  </div>
                </div>
              </div>
</div>
<div id="myModalAdd" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มข้อมูลระดับ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อระดับ <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="name" class="form-control col-md-7 col-xs-12" name="name" type="text" onchange="validateName(this)">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">เปอร์เซน <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="gross" value="0" class="form-control col-md-7 col-xs-12" name="gross" required="required" type="number" min="0" max="3" onchange="validatePersen(this)">
                          </div>
                        </div>

                    </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitAddClass()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

<div id="myModalShow" class="modal fade" tabindex="-1">
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ข้อมูลระดับ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr>
                          <td>ลำดับ</td>
                          <th>ชื่อระดับ</th>
                          <th>ลดเปอร์เซน</th>
                          <th>แก้ไข</th>
                          <th>ลบ</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $numPop = 0;
                        $sqlclass=" select 
                        c.*
                        from 
                        class c ";
                        $rsdclass=$cls_conn->select_base($sqlclass);
                        while($class=mysqli_fetch_array($rsdclass))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $numPop; ?></td>
                          <td><?php echo $class['name']; ?></td>
                          <td><?php echo $class['grossProfit']."%"; ?></td>
                          <td><a onclick="editClass('<?php echo $class['row_id']; ?>')" ><i class="fa fa-edit"></i></a></td>
                          <td><a onclick="deleteClass('<?php echo $class['row_id']; ?>')" ><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php 
                       }
                        ?>
                      </tbody>
                    </table>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModalEdit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขข้อมูลระดับ</h5>
                    <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                </div>
                <br>
                <div class="modal-body">
                <form method="post" id="editNumberFlag" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อ-สกุล <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="newname" class="form-control col-md-7 col-xs-12" name="newname" placeholder="ชื่อนามสกุล" required="required" type="text" onchange="validateName(this)">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpersen">เปอร์เซน <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" value="0" min="0" max="3" id="newpersen" name="newpersen" required="required" class="form-control col-md-7 col-xs-12" onchange="validatePersen(this)">
                        </div>
                        </div>
                    </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backmamu('myModalEdit')" >กลับไปเมนูหลัก</button>
                    <button type="button" onclick="updateClass()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

<script>
var rowIdClass = null;
var nameEdit = null;
function oncheckUpdate(datainput){
if(datainput.checked == true){
    $.ajax({
            type: 'POST',
            data: "action=add&rowIdMember="+datainput.value,
            url: '../functions/classMember/check_member.php',
            dataType: 'html',
            success: function(data) {
              $('#showlistUpdate').html(data);
            }
        })
}else if(datainput.checked == false){
    $.ajax({
            type: 'POST',
            data: "action=del&rowIdMember="+datainput.value,
            url: '../functions/classMember/check_member.php',
            dataType: 'html',
            success: function(data) {
              $('#showlistUpdate').html(data);
            }
        })
}
}
function delClass(keyId,memberId){
  $.ajax({
            type: 'POST',
            data: "action=delbutton&keyId="+keyId,
            url: '../functions/classMember/check_member.php',
            dataType: 'html',
            success: function(data) {
              $('#showlistUpdate').html(data);
              var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

              for (var i = 0; i < checkboxes.length; i++) {
                if(memberId == checkboxes[i].value){
                  checkboxes[i].checked = false;
                }
              }
            }
        })
}
function updClass(){
  $.ajax({
            type: 'POST',
            data: "classchange="+document.getElementById('classMember').value,
            url: '../functions/classMember/update_class_member.php',
            dataType: 'html',
            success: function(data) {
              if(data == "Error"){
                alert("อัพเดทข้อมูลระดับไม่สำเร็จ");
              }else if(data == "Success"){
                alert("อัพเดทข้อมูลระดับสำเร็จ");
              }    
              location.reload();
            }
        })
}
function addClass(){
  $("#myModalAdd").modal('show');
}
function submitAddClass(){
  $.ajax({
            type: 'POST',
            data: "classname="+document.getElementById('name').value+
            "&grossProfit="+document.getElementById('gross').value,
            url: '../functions/classMember/insert_class_member.php',
            dataType: 'html',
            success: function(data) {
              if(data == "Error"){
                alert("เพิ่มข้อมูลระดับไม่สำเร็จ");
              }else if(data == "Success"){
                alert("เพิ่มข้อมูลระดับสำเร็จ");
              }    
              location.reload();
            }
        })
}
function showClass(){
  $("#myModalShow").modal('show');
}
//Edit Profile
function editClass(rowId){
  rowIdClass = rowId;
    $.ajax({
        url:"../functions/classMember/class_allquery.php",
        method:"POST",
        data:"idclass="+rowId,
        success:function(data)
        {
          var res = data.split("|");
          rowIdMemberUpdate = res[0];
          nameEdit = res[1];
          $(".modal-body #newname").val(res[1]);
          $(".modal-body #newpersen").val(res[2]);

          $("#myModalEdit").modal('show');
          $("#myModalShow").modal('hide');
        }
        })
}
function backmamu(name){
    nameEdit = null;
    $("#"+name).modal('hide');
    $("#myModalShow").modal('show');
}
function updateClass(){
  nameEdit = null;
  $.ajax({
            type: 'POST',
            data: "rowIdMain="+rowIdClass+
            "&grossProfit="+document.getElementById('newpersen').value+
            "&nameClass="+document.getElementById('newname').value,
            url: '../functions/classMember/update_class_main.php',
            dataType: 'html',
            success: function(data) {
              if(data == "Error"){
                alert("เปลี่ยนข้อมูลระดับไม่สำเร็จ");
              }else if(data == "Success"){
                alert("เปลี่ยนข้อมูลระดับสำเร็จ");
              }    
              location.reload();
            }
        })
}
function validatePersen(persenData){
  if(persenData.value > 100){
    alert("คุณใส่เปอร์เซนเกิน 100% กรุณากรอกใหม่");
    persenData.value = '0';
  }
}
function validateName(nameData){
  $.ajax({
        url:"../functions/classMember/class_checkname_query.php",
        method:"POST",
        data:"nameclass="+nameData.value,
        success:function(data)
        {
          if(nameEdit == null || nameEdit != nameData.value){
            if(data == "Error"){
              alert("คุณกรอกชื่อซ้ำกรุณากรอกใหม่");
              if(nameEdit != null){
                nameData.value = nameEdit;
              }else{
                nameData.value = '';
              }
            }
          }
        }
        })
}
function deleteClass(rowId){
  if(confirm("คุณต้องการลบข้อมูลใช่หรือไม่")){
    $.ajax({
              type: 'POST',
              data: "rowIdMain="+rowId,
              url: '../functions/classMember/del_class_main.php',
              dataType: 'html',
              success: function(data) {
                if(data == "Error"){
                  alert("ลบข้อมูลระดับไม่สำเร็จ");
                }else if(data == "Error1"){
                  alert("มีข้อมูลบุคคลที่เป็นระดับนี้อยู่ไม่สามารถลบได้ กรุณาเปลี่ยนระดับของบุคคลก่อน");
                }else if(data == "Success"){
                  alert("ลบข้อมูลระดับสำเร็จ");
                }    
                location.reload();
              }
          })
  }
}
</script>
