<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$configid = $_POST['configid'];

$grossProfit = $_POST['grossProfit'];

if($configid != ''){
    $sqlUpdateConfig=" update class set ";
    if($grossProfit != ''){
        $sqlUpdateConfig.="grossProfit='$grossProfit' ";
    }
    $sqlUpdateConfig.="where row_id='$configid' ";
    $cls_conn->write_base($sqlUpdateConfig);
}
?>