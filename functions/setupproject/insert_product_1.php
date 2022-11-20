<?php
include('../../connect/class_conn.php');
session_start();
$cls_conn=new class_conn;

$sqlUUidp="select UUID() as row_id from dual";
$rsuuidp=$cls_conn->select_base($sqlUUidp);
$rowuuidp=mysqli_fetch_array($rsuuidp);
$rowIdTime = $rowuuidp['row_id'];
$_SESSION['rowId_date'] = $rowuuidp['row_id'];

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
//check Number Error
$sqlNumberErr="select p.* from lotto_product p where not EXISTS (select p1.* from lotto_product p1 , lotto_time t1 where p1.time_id = t1.row_id and p.row_id = p1.row_id)";
$rsdErr=$cls_conn->select_base($sqlNumberErr);
while($NumErr=mysqli_fetch_array($rsdErr))
{
    $rowIdErr = $NumErr['row_id'];
    $sqlNumEr = "DELETE FROM lotto_product WHERE row_id = '$rowIdErr'";
    $cls_conn->write_base($sqlNumEr);
}
$priceFlg = 0;
$flag_fix = 'N';

$sqlConfigBuy="select lc.* from lotto_config lc where lc.lotto_type = 'project_default_buy' and lc.active_flg = 'Y' ";
$rsdCB=$cls_conn->select_base($sqlConfigBuy);
$configBuy=mysqli_fetch_array($rsdCB);
if($configBuy['lotto_val1'] != ''){
    $priceFlg = $configBuy['lotto_val1'];
    $flag_fix = 'Y';
}

for($i=0;$i <= 999;$i++){
        // 1 หลัก
        if(strlen($i) <= 1){    
            $number_lotto1 = str_pad($i,  1, "0",STR_PAD_LEFT);
            for($ty=0;$ty<=3;$ty++){
                if($ty == 0){
                    if(isset($_POST['priceh1'])){
                        $priceh1 = $_POST['priceh1'];
                    }else{
                        $priceh1 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto1','$flag_fix','$priceh1','H1','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }else if($ty == 1){
                    if(isset($_POST['pricel1'])){
                        $pricel1 = $_POST['pricel1'];
                    }else{
                        $pricel1 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto1','$flag_fix','$pricel1','L1','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }
            } 
        }
        // 2 หลัก
        if(strlen($i) <= 2){   
            $number_lotto2 = str_pad($i,  2, "0",STR_PAD_LEFT);
            for($ty=0;$ty<=3;$ty++){
                if($ty == 0){
                    if(isset($_POST['priceh2'])){
                        $priceh2 = $_POST['priceh2'];
                    }else{
                        $priceh2 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto2','$flag_fix','$priceh2','H2','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }else if($ty == 1){
                    if(isset($_POST['pricel2'])){
                        $pricel2 = $_POST['pricel2'];
                    }else{
                        $pricel2 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto2','$flag_fix','$pricel2','L2','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }
            } 
        }
        // 3 หลัก
        if(strlen($i) <= 3){ 
            $number_lotto3 = str_pad($i,  3, "0",STR_PAD_LEFT);
            for($ty=0;$ty<=2;$ty++){
                if($ty == 0){
                    if(isset($_POST['priceh3'])){
                        $priceh3 = $_POST['priceh3'];
                    }else{
                        $priceh3 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto3','$flag_fix','$priceh3','H3','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }else if($ty == 1){
                    if(isset($_POST['pricel3'])){
                        $pricel3 = $_POST['pricel3'];
                    }else{
                        $pricel3 = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto3','$flag_fix','$pricel3','L3','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }else if($ty == 2){
                    if(isset($_POST['pricet'])){
                        $pricet = $_POST['pricet'];
                    }else{
                        $pricet = 0;
                    }
                    $sqlPro = "INSERT INTO `lotto_product` (`row_id`, `name`, `flag_fix`, `price`, `type`, `price_fix` , `time_id`) VALUES ";
                    $sqlPro.= "(UUID(), '$number_lotto3','$flag_fix','$pricet','T3','$priceFlg','$rowIdTime')";
                    $cls_conn->write_base($sqlPro);
                }
            } 
        }
}
?>