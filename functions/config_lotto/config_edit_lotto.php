<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$id = $_POST['configid'];
$sqlConfig="select lc.* from lotto_config lc where lc.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlConfig);
$configAll=mysqli_fetch_array($rsdAll);

echo $configAll['row_id']."|".$configAll['lotto_name']."|".$configAll['lotto_val1']."|".$configAll['lotto_val2']."|".$configAll['lotto_val3']."|".$configAll['lotto_val4']."|".$configAll['lotto_val5']."|".$configAll['active_flg'];
?>