<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$status = "Error";
if(isset($_POST['classchange'])){
  $classchange = $_POST['classchange'];
}

if(isset($_SESSION['rowIdMember']) && $_SESSION['rowIdMember'] != '' && count($_SESSION['rowIdMember']) > 0){
    foreach($_SESSION['rowIdMember'] as $key => $rowIdMember) {
        if($rowIdMember != '' && $classchange != ''){
            $sqlUpdateMember=" update member set ";
            $sqlUpdateMember.=" class='$classchange' ";
            $sqlUpdateMember.="where row_id='$rowIdMember' ";
            $cls_conn->write_base($sqlUpdateMember);
        }
    }
    $status = "Success";
}
echo $status;
?>
