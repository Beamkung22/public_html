<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$id = $_POST['idMember'];
$sqlMemAll="select m.* , lc.lotto_name status_name from member m , lotto_config lc where lc.row_id = m.status and m.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlMemAll);
$MemAll=mysqli_fetch_array($rsdAll);

echo $MemAll['row_id']."|".$MemAll['name']."|".$MemAll['Email']."|".$MemAll['tel']."|".$MemAll['status']."|".$MemAll['class']."|".$MemAll['status_name']."|".$MemAll['accountno'];
?>