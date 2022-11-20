<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$id = $_POST['idTime'];
$sqlTimeAll="select t.* from lotto_time t where t.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlTimeAll);
$TimeAll=mysqli_fetch_array($rsdAll);

echo $TimeAll['row_id']."|".str_replace(" ","T",$TimeAll['time_open'])."|".str_replace(" ","T",$TimeAll['time_close']);
?>