<?php
include('../../connect/class_conn.php');
session_start();
$cls_conn=new class_conn;
$rowIdTime = $_SESSION['rowId_date'];

if(isset($_SESSION["data"])){
    foreach($_SESSION['dataEdit'] as $key => $one) {
        $priceEdit = $_SESSION['dataEdit'][$key];
        $rowIdUpdate = $_SESSION['rowId'][$key];
        $sqlProUpdate = " UPDATE `lotto_product` ";
        $sqlProUpdate.= " SET price = '$priceEdit' ";
        $sqlProUpdate.= " WHERE row_id = '$rowIdUpdate' ";
        $cls_conn->write_base($sqlProUpdate);

        $dateTimeCurIns = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
        $StrdateCurIns = date("Y-m-d H:i:s",strtotime($dateTimeCurIns->format("Y-m-d H:i:s")));

        $sqlProHis = "INSERT INTO `lotto_history_price` (`row_id`, `date_create`, `price`, `product_id`, `time_id`) VALUES ";
        $sqlProHis.= "(UUID(), '$StrdateCurIns','$priceEdit','$rowIdUpdate','$rowIdTime')";
        $cls_conn->write_base($sqlProHis);
    }
}

if(isset($_POST['reservation-time'])){   
    $namepro = $_POST['nameproject'];
    $dateTo = $_POST['reservation-time'];
    $date = explode("-",$dateTo);
    $timeopen = date('Y-m-d H:i:s',strtotime($date[0]));
    $timeclose = date('Y-m-d H:i:s',strtotime($date[1]));
    $sqlPro = "INSERT INTO `lotto_time` (`row_id`, `time_open`, `time_close`, `status` , `name`) VALUES ";
    $sqlPro.= "('$rowIdTime', '$timeopen','$timeclose','Pending','$namepro')";
    $cls_conn->write_base($sqlPro);

}


if(isset($_SESSION["dataSell"])){
    foreach($_SESSION['dataEditSell'] as $key => $one) {
        $priceEdit = $_SESSION['dataEditSell'][$key];
        $rowIdUpdate = $_SESSION['rowIdSell'][$key];
        $sqlProflx = " UPDATE `lotto_product` ";
        $sqlProflx.= " SET price_fix = '$priceEdit' , ";
        $sqlProflx.= " flag_fix = 'Y' ";
        $sqlProflx.= " WHERE row_id = '$rowIdUpdate' ";
        $cls_conn->write_base($sqlProflx);
    }
}

unset($_SESSION['dataEdit']);
unset($_SESSION['dataOld']);
unset($_SESSION['number']);
unset($_SESSION['type']);
unset($_SESSION['data']);
unset($_SESSION['rowId']);
unset($_SESSION['changenumber_setting']);
unset($_SESSION['T_changenumber']);
unset($_SESSION['Type2']);
unset($_SESSION['intLineItem']);

unset($_SESSION['dataEditSell']);
unset($_SESSION['dataOldSell']);
unset($_SESSION['numberSell']);
unset($_SESSION['typeSell']);
unset($_SESSION['dataSell']);
unset($_SESSION['rowIdSell']);

unset($_SESSION['rowId_date']);
?>