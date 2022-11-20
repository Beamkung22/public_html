<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$totalmoney = 0;
$numsell = 0;
$persen = 0;
$discount = 0;
$totalmoneydis = 0;
if(isset($_SESSION['numbercast'])){
    foreach($_SESSION['numbercast'] as $key => $type) {
        foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
            $totalmoney = $totalmoney+$_SESSION['inputprice'][$keyvalue];
            $numsell++;
        }
    }
}
if(isset($_SESSION['id_member'])){
    $rowIdMember = $_SESSION['id_member'];
    $query = "SELECT c.grossProfit FROM member m , class c WHERE m.row_id = '$rowIdMember' and m.class = c.row_id";
	$list = $cls_conn->select_base($query);
    $row = mysqli_fetch_array($list);
    if($row['grossProfit'] != '' && $row['grossProfit'] > 0){
        $persen = $row['grossProfit'];
        $discount = ($totalmoney*$persen)/100;
        $totalmoneydis = $totalmoney - $discount;
    }else{
        $totalmoneydis = $totalmoney;
    }
}
echo $numsell." รายการ | จำนวนเงิน ".number_format($totalmoney)." บาท<br>";
echo "ส่วนลด ".number_format($persen)." % | ".number_format($discount)." บาท <br>";
echo $numsell." รายการ | จำนวนเงิน ".number_format($totalmoneydis)." บาท";
?>