<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;

if(isset($_POST['action'])){
    if($_POST['action'] == "add"){
        if(isset($_SESSION['intLinecastclass']) && $_SESSION['intLinecastclass'] != ""){
            $_SESSION['intLinecastclass']++;
        }else{
            $_SESSION['intLinecastclass']='0';
        }
        $cast_num = $_SESSION['intLinecastclass'];
        $_SESSION['rowIdMember'][$cast_num] = $_POST['rowIdMember'];
    }else if($_POST['action'] == "del"){
        if(isset($_SESSION['rowIdMember'])){
            foreach($_SESSION['rowIdMember'] as $key => $rowIdMember) {
                if($rowIdMember == $_POST['rowIdMember']){
                    unset($_SESSION['rowIdMember'][$key]);
                }
            }
        }
    }else if($_POST['action'] == "delbutton"){
        if(isset($_POST['keyId'])){
            $keyId = $_POST['keyId'];
        }
        if(isset($_SESSION['rowIdMember'])){
            unset($_SESSION['rowIdMember'][$keyId]);
        }
    }
    
}

if(isset($_SESSION['rowIdMember']) && $_SESSION['rowIdMember'] != '' && count($_SESSION['rowIdMember']) > 0){?>
<div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:50%;">
                      <select required id="classMember" name="classMember" class="form-control">
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
                      <button class="btn btn-round btn-info" onclick="updClass()">ยืนยัน</button>
                    </div>
                    <div  class="x_panel">
                    <div class="x_title">
                        <h2>รายชื่อจัดการระดับ</h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

    <table class="table">
                        <thead>
                            <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อนามสกุล</th>
                            <th>ระดับเก่า</th>
                            <th>ลบข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    $numrow = 1;
    foreach($_SESSION['rowIdMember'] as $key => $rowIdMember) {
        $sqld=" select m.row_id ,
        m.name ,
        c.name class
        from member m, 
        class c 
        where m.class = c.row_id 
        and m.row_id = '$rowIdMember' ";
        $rsd=$cls_conn->select_base($sqld);
        $member=mysqli_fetch_array($rsd);
        ?>
        <tr>
        <th><?php echo $numrow; ?></th>
        <td><?php echo $member['name']; ?></td>
        <td><?php echo $member['class']; ?></td>
        <td style='text-align: center;'><a onclick="delClass('<?php echo $key; ?>','<?php echo $member['row_id']; ?>')"><i class='fa fa-minus-square' ></i></a></td>
        </tr>
       <?php
            $numrow++;
    }
    ?>
    </tbody>
                        </table>
                        </div>
                    </div>
<?php
}
?>
