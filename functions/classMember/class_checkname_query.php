<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$nameclass = $_POST['nameclass'];
$sqlClassAll="select c.* from class c where c.name = '$nameclass' ";
$rsdAll=$cls_conn->select_base($sqlClassAll);
$ClassAll=mysqli_fetch_array($rsdAll);
$status = "Success";
if($ClassAll['row_id'] != ''){
    $status = "Error";
}
echo $status;
?>