<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$id = $_POST['idNumber'];
$sqlNumberAll="select p.* from lotto_product p where p.row_id = '$id' ";
$rsdAll=$cls_conn->select_base($sqlNumberAll);
$NumAll=mysqli_fetch_array($rsdAll);

echo $NumAll['row_id']."|".$NumAll['name']."|".$change_language->change_type($NumAll['type'])."|".$NumAll['flag_fix']."|".$NumAll['price_fix']."|".$NumAll['price'];
?>