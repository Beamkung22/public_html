<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$tiemId = $_POST['idTime'];


if($tiemId != ''){
    $sqlUpdateTime=" delete from lotto_time ";
    $sqlUpdateTime.="where row_id='$tiemId' ";
    $cls_conn->write_base($sqlUpdateTime);

    $sqlNumEr = "DELETE FROM lotto_product WHERE time_id = '$tiemId'";
    $cls_conn->write_base($sqlNumEr);
}
?>