<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$gen_numberNo=new gen_numberNo;
$change_language = new change_language;
$valdatecast = true;
$totalpricebuy = 0;
$emd_id = $_SESSION['id_member'];
$return = '';
if((isset($rowIdTime) && $rowIdTime == '') || !isset($rowIdTime)){
    unset($_SESSION['numbercast']);
    unset($_SESSION['typenumber']);
    unset($_SESSION['totalprice']);
    unset($_SESSION['inputprice']);
    unset($_SESSION['datainput']);
    unset($_SESSION['intLinecast']);
    $return = "Error4";
}else{
    if(isset($_SESSION['numbercast'])){
        //validate cast
        foreach($_SESSION['numbercast'] as $key => $type) {
            foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
                $pricebuy = $_SESSION['inputprice'][$keyvalue];
                $totalpricebuy = $totalpricebuy + $pricebuy;
                if($pricebuy == 0){
                    $valdatecast = false;
                    break;
                }else if($pricebuy < 0){
                    $valdatecast = false;
                    break;
                }
                $typenumber = $key;
                $number = $value;
                $sqlItem_pro=" select p.row_id , p.flag_fix , p.price_fix from lotto_product p where p.name = '$number' ";
                $sqlItem_pro.=" and p.type = '$typenumber' ";
                $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                
                $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                $item_pro=mysqli_fetch_array($rsdItem_pro);
                $proId = $item_pro['row_id'];       
                $proflag = $item_pro['flag_fix'];
                $proprice = $item_pro['price_fix'];
                if($proflag == 'Y'){
                    $proprice = $proprice - $pricebuy;
                    if($proprice < 0){
                        $valdatecast = false;
                        $return = "Error3|".$number."|".$change_language->change_type($typenumber)."|".$item_pro['price_fix'];
                        break;
                    }
                }
            }
        }
        if($valdatecast){
            $sqlemd =" select e.credit , c.grossProfit from member e , class c where e.row_id = '$emd_id' and e.class = c.row_id";
            $rsdemd=$cls_conn->select_base($sqlemd);
            $creditemd=mysqli_fetch_array($rsdemd);
            if($creditemd['grossProfit'] != '' && $creditemd['grossProfit'] > 0){
                $persen = $creditemd['grossProfit'];
                $discount = ($totalpricebuy*$persen)/100;
                $totalpricebuy = $totalpricebuy - $discount;
            }
            $monenyemd = $creditemd['credit'];
            $monenyemd = $monenyemd - $totalpricebuy;
            if($monenyemd < 0){
                $valdatecast = false;
                $return = "Error2";
            }else{
                $sqlUpdateMoney=" update member set credit='$monenyemd' where row_id='$emd_id' ";
                $cls_conn->write_base($sqlUpdateMoney);
            }
        }else{
            if($return == ''){
                $return = "Error1";
            }
        }
        //insert cast
        if($valdatecast){
            foreach($_SESSION['numbercast'] as $key => $type) {
                foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
                    $userNo = $gen_numberNo->gen_user($cls_conn,$rowIdTime);
                    $typenumber = $key;
                    $number = $value;
                    $sqlItem_pro=" select p.row_id , p.flag_fix , p.price_fix from lotto_product p where p.name = '$number' ";
                    $sqlItem_pro.=" and p.type = '$typenumber' ";
                    $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
        
                    $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                    $item_pro=mysqli_fetch_array($rsdItem_pro);
                    $proId = $item_pro['row_id'];
                    $proflag = $item_pro['flag_fix'];
                    $proprice = $item_pro['price_fix'];
                    
                    $pricebuy = $_SESSION['inputprice'][$keyvalue];
                    $emd_id = $_SESSION['id_member'];
        
                    $dateTimeCur_In = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
                    $StrdateCur_In =  $dateTimeCur_In->format("Y-m-d H:i:s");

                    $sqlItem = "INSERT INTO `lotto_item_user` (`row_id`, `product_id`,`member_id`,`numberNo` , `price`, `time_id`, `create_dt`, `status_cd`) VALUES ";
                    $sqlItem.= "(UUID(), '$proId','$emd_id','$userNo','$pricebuy','$rowIdTime','$StrdateCur_In','Pending')";
        
                    $cls_conn->write_base($sqlItem);
    
                    if($proflag == 'Y'){
                        $proprice = $proprice - $pricebuy;
                        $sqlUpdatePro=" update lotto_product set price_fix='$proprice' where row_id='$proId' ";
                        $cls_conn->write_base($sqlUpdatePro);
                    }
                }
            }
            unset($_SESSION['numbercast']);
            unset($_SESSION['typenumber']);
            unset($_SESSION['totalprice']);
            unset($_SESSION['inputprice']);
            unset($_SESSION['datainput']);
            unset($_SESSION['intLinecast']);
            $return = "Success";
        }
    }
}
echo $return;
?>