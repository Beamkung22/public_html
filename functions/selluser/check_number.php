<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$numberset = $_POST['number'];
$typenumber = $_POST['typenumber'];

$sqlNumberAll="select p.* from lotto_product p where p.name = '$numberset' and p.type = '$typenumber' and p.time_id = '$rowIdTime'";
$rsuNumAll=$cls_conn->select_base($sqlNumberAll);
$numberAll=mysqli_fetch_array($rsuNumAll);
$sqlNumberPrice="select l.lotto_val1 from lotto_config l where l.lotto_name = '$typenumber' and l.lotto_type = 'price_project' and l.active_flg = 'Y' ";
$rsuNumPrice=$cls_conn->select_base($sqlNumberPrice);
$numberPrice=mysqli_fetch_array($rsuNumPrice);
$flagConfigPrice = 'Y';
if($numberPrice['lotto_val1'] == $numberAll['price']){
    $flagConfigPrice = 'N';
}
//'65319254-fda0-11eb-92ee-2cfda1bb2bab'
echo $numberAll['flag_fix']."|".$numberAll['price_fix']."|".$change_language->change_type($numberAll['type'])."|".$flagConfigPrice."|".$numberAll['price'];
?>