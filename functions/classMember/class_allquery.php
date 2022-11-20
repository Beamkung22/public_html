<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$id = $_POST['idclass'];
$sqlClassAll="select c.* from class c where c.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlClassAll);
$ClassAll=mysqli_fetch_array($rsdAll);

echo $ClassAll['row_id']."|".$ClassAll['name']."|".$ClassAll['grossProfit'];
?>