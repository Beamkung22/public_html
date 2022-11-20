<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$id = $_POST['idMember'];
$sqlMemAll="select m.* from member m where m.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlMemAll);
$MemAll=mysqli_fetch_array($rsdAll);

echo $MemAll['row_id']."|".$MemAll['name']."|".$MemAll['credit'];
?>