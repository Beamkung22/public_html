<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$id = $_POST['configid'];
$sqlConfig="select c.* from class c where c.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlConfig);
$configAll=mysqli_fetch_array($rsdAll);

echo $configAll['row_id']."|".$configAll['name']."|".$configAll['grossProfit'];
?>