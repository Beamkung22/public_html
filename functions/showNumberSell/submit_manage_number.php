<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$proId = $_POST['idNumber'];
if(isset($_POST['flagfix'])){
    $flagfix = $_POST['flagfix'];
}else{
    $flagfix = "";
}
if(isset($_POST['pricefix'])){
    $pricefix = $_POST['pricefix'];
}else{
    $pricefix = "";
}
if(isset($_POST['price'])){
    $price = $_POST['price'];
}else{
    $price = "";
}
if($proId != ''){
    $sqld=" select lp.price , lp.time_id , lp.type , lp.name from lotto_product lp where lp.row_id = '$proId' ";
    $rsd=$cls_conn->select_base($sqld);
    $product=mysqli_fetch_array($rsd);
    $timeId = $product['time_id'];
    $typenumber = $product['type'];

    if($product['type'] == 'T3'){
        $number = $product['name'];
        $number1 = null;
        $number2 = null;
        $number3 = null;
        $number4 = null;
        $number5 = null;
        $number6 = null;
        $datachange = array();
        $sizenumber = strlen($number);
        //010
        $number1 = substr($number,0,1).substr($number,1,1).substr($number,2,1);
        //001
        $number2 = substr($number,0,1).substr($number,2,1).substr($number,1,1);
        //100
        $number3 = substr($number,1,1).substr($number,2,1).substr($number,0,1);                   
        //010
        $number4 = substr($number,2,1).substr($number,1,1).substr($number,0,1);
        //100
        $number5 = substr($number,1,1).substr($number,0,1).substr($number,2,1);
        //001
        $number6 = substr($number,2,1).substr($number,0,1).substr($number,1,1);
        //set array
        if($number1 == $number2 && $number1 == $number3 
        && $number1 == $number4 && $number1 == $number5 
        && $number1 == $number6 ){
            array_push($datachange,$number1);
        }else if($number1 == $number2 && $number3 == $number4 
        && $number5 == $number6 && $number2 != $number3 
        && $number4 != $number5 ){
            array_push($datachange,$number1,$number3,$number5);
        }else if($number1 == $number5 && $number2 == $number3
        && $number4 == $number6 && $number5 != $number2 
        && $number3 != $number4 ){
            array_push($datachange,$number1,$number2,$number4);
        }else if($number1 == $number4 && $number2 == $number6
        && $number3 == $number5 && $number4 != $number2 
        && $number6 != $number3 ){
            array_push($datachange,$number1,$number2,$number3);
        }else{
            array_push($datachange,$number1,$number2,$number3,$number4,$number5,$number6);
        }
    }

    if(isset($datachange) && sizeof($datachange) > 0){
        foreach($datachange as $key => $numberset){
            $sqlNumberAll="select p.* from lotto_product p where p.name = '$numberset' and p.type = '$typenumber' and p.time_id = '$timeId'";
            $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
            $numberAll=mysqli_fetch_array($rsuNumAll);
            $proId = $numberAll['row_id'];
            $sqlUpdatePro=" update lotto_product set ";
            if($price != '' && $product['price'] != $price){
                $sqlUpdatePro.="price='$price'";
                $dateTimeCurIns = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
                $StrdateCurIns = date("Y-m-d H:i:s",strtotime($dateTimeCurIns->format("Y-m-d H:i:s")));
                $sqlProHis = "INSERT INTO `lotto_history_price` (`row_id`, `date_create`, `price`, `product_id`, `time_id`) VALUES ";
                $sqlProHis.= "(UUID(), '$StrdateCurIns','$price','$proId','$timeId')";
                $cls_conn->write_base($sqlProHis);
            }
            if($pricefix != ''){
                $sqlUpdatePro.="price_fix='$pricefix'";
                if($flagfix != ''){
                    $sqlUpdatePro.=", flag_fix='$flagfix'";
                }else{
                    $sqlUpdatePro.=", flag_fix='N'";
                }
            }
            if($pricefix != '' || ($price != '' && $product['price'] != $price)){
                $sqlUpdatePro.="where row_id='$proId' ";
                $cls_conn->write_base($sqlUpdatePro);
            }
        }
    }else{
        $sqlUpdatePro=" update lotto_product set ";
        if($price != '' && $product['price'] != $price){
            $sqlUpdatePro.="price='$price'";
            if($product['type'] == 'H2' || $product['type'] == 'L2'){
                $number = $product['name'];
                $sqld=" select lp.row_id , lp.price , lp.time_id , lp.type , lp.name from lotto_product lp where lp.name = '$number' and lp.time_id = '$timeId'";
                $rsd=$cls_conn->select_base($sqld);
                while($product2=mysqli_fetch_array($rsd))
                {
                    $proId = $product2['row_id'];
                    $dateTimeCurIns = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
                    $StrdateCurIns = date("Y-m-d H:i:s",strtotime($dateTimeCurIns->format("Y-m-d H:i:s")));
                    $sqlProHis = "INSERT INTO `lotto_history_price` (`row_id`, `date_create`, `price`, `product_id`, `time_id`) VALUES ";
                    $sqlProHis.= "(UUID(), '$StrdateCurIns','$price','$proId','$timeId')";
                    $cls_conn->write_base($sqlProHis);
                    if(isset($UpdateRowId) && $UpdateRowId != ""){
                        $UpdateRowId .= ",'".$proId."'";
                    }else{
                        $UpdateRowId = "'".$proId."'";
                    }
                }
            }else{
                $dateTimeCurIns = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
                $StrdateCurIns = date("Y-m-d H:i:s",strtotime($dateTimeCurIns->format("Y-m-d H:i:s")));
                $sqlProHis = "INSERT INTO `lotto_history_price` (`row_id`, `date_create`, `price`, `product_id`, `time_id`) VALUES ";
                $sqlProHis.= "(UUID(), '$StrdateCurIns','$price','$proId','$timeId')";
                $cls_conn->write_base($sqlProHis);
            }
        }
        if($pricefix != ''){
            $sqlUpdatePro.="price_fix='$pricefix'";
            if($flagfix != ''){
                $sqlUpdatePro.=", flag_fix='$flagfix'";
            }else{
                $sqlUpdatePro.=", flag_fix='N'";
            }
        }
        if($pricefix != '' || ($price != '' && $product['price'] != $price)){
            if(isset($UpdateRowId) && $UpdateRowId != ""){
                $sqlUpdatePro.="where row_id in (".$UpdateRowId.") ";
            }else{
                $sqlUpdatePro.="where row_id='$proId' ";
            }
            $cls_conn->write_base($sqlUpdatePro);
        }
    }

}
?>