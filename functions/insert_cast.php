<?php 
include('../connect/class_conn.php');
include('logicmain.php');
session_start();
$cls_conn=new class_conn;
$booleanCheckNumber = true;
$booleanInsertOrder = true;
$rowIdTime = "";
$price = 0;
$proId = "";
$totalprice = 0;
$creditMoney = 0;
$datareturn = "Success";

$sqlUUid="select UUID() as row_id from dual";
$rsuuid=$cls_conn->select_base($sqlUUid);
$rowuuid=mysqli_fetch_array($rsuuid);
$orderId = $rowuuid['row_id'];

$sqlTime=" select t.* from lotto_time t where t.status = 'Open' ";
$rsdTime=$cls_conn->select_base($sqlTime);
while($time=mysqli_fetch_array($rsdTime))
{ 
    $dateTimeStart = new DateTime($time["time_open"],new DateTimeZone('Asia/Bangkok'));
    $dateTimeEnd = new DateTime($time["time_close"],new DateTimeZone('Asia/Bangkok'));
    $StrdateStart =  $dateTimeStart->format("m/d/y  H:i A");
    $StrdateEnd =  $dateTimeEnd->format("m/d/y  H:i A");
    if($StrdateCur <= $StrdateEnd && $StrdateCur >= $StrdateStart){
        $rowIdTime = $time['row_id'];
    }
}
if($rowIdTime != ""){
    //$_SESSION['id_member']
    //Check Money Member
    foreach(explode(",",$_POST['dataall']) as $values):
        $values = trim($values,"'");
        if($booleanCheckNumber){
            if(isset($values) && $values != ""){
                //echo "ตัวเลข".$values."=".strlen($values).'<br/>';
                $numberlen = strlen($values);
                if($numberlen != 0){
                    $booleanCheckNumber = false;
                    $price = 0;
                }
            }
    
        }else{
            $price++;
            //echo "จำนวนเงิน".$values."=".$price.'<br/>';
            if(isset($values) && $values != ""){
                $totalprice = $totalprice+$values;
            }  
    
            if($price == $numberlen){
                $booleanCheckNumber = true;
            }
        }    
    endforeach;

    $sqlUserId = $_SESSION['id_member'];
    $sqlUser="select m.credit from member m where m.row_id = '$sqlUserId' ";
    $rsuuser=$cls_conn->select_base($sqlUser);
    $rowuser=mysqli_fetch_array($rsuuser);
    $creditMoney = $rowuser['credit'];
    $totalMoney = $creditMoney - $totalprice;
    
    if($totalprice != 0){
        // Update Money User
        $sqlUpdateMoney=" update member set credit='$totalMoney' where row_id='$sqlUserId' ";
        $cls_conn->write_base($sqlUpdateMoney);

        // Condition Insert Item
        foreach(explode(",",$_POST['dataall']) as $values):
            $values = trim($values,"'");
            if($booleanCheckNumber){
                if(isset($values) && $values != ""){
                    //echo "ตัวเลข".$values."=".strlen($values).'<br/>';
                    //ตัวเลข
                    $numbersell = $values;
                    $numberlen = strlen($values);
                    if($numberlen == 1){
                    //เลขวิ่ง
                    $TypeR = "R";
                    }else if($numberlen == 2){
                    //เลข 2 ตัว
                    $TypeH = "H2";
                    $TypeL = "L2";
                    }else if($numberlen == 3){
                    //เลข 3 ตัว
                    $TypeH = "H3";
                    $TypeL = "L3";
                    $TypeT = "T3";
                    }
                    if($numberlen != 0){
                        $booleanCheckNumber = false;
                        $price = 0;
                        $proId = "";
                    }
                    if($booleanInsertOrder){
                        $order_no = $_POST['orderNo'];
                        $userId = $_SESSION['id_member'];
                        $namecreate = $_SESSION['name'];
        
                        $sqlOrder = "INSERT INTO `lotto_order` (`row_id`, `order_no`, `member_id` , `create_dt`, `create_by` , `last_upd`, `last_upd_by`) VALUES ";
                        $sqlOrder.= "('$orderId', '$order_no','$userId',sysdate(),'$namecreate',sysdate(),'$namecreate')";
                        
                        $cls_conn->write_base($sqlOrder);
                    }
                    $booleanInsertOrder = false;
                }
        
            }else{
                $price++;
                //echo "จำนวนเงิน".$values."=".$price.'<br/>';
                if(isset($values) && $values != ""){
                    if($numberlen > 1){
                        if($price == 1){
                            $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$numbersell' ";
                            $sqlItem_pro.=" and p.type = '$TypeL' ";
                            $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                        }else if($price == 2){
                            $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$numbersell' ";
                            $sqlItem_pro.=" and p.type = '$TypeH' ";
                            $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                        }else if($price == 3){
                            $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$numbersell' ";
                            $sqlItem_pro.=" and p.type = '$TypeT' ";
                            $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                        }
                    }else{
                        $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$numbersell' ";
                        $sqlItem_pro.=" and p.type = '$TypeR' ";
                        $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                    }

                    $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                    while($item_pro=mysqli_fetch_array($rsdItem_pro)){
                        $proId = $item_pro['row_id'];
                    }
        
                    $sqlItem = "INSERT INTO `lotto_item` (`row_id`, `product_id`, `order_id`, `price`) VALUES ";
                    $sqlItem.= "(UUID(), '$proId','$orderId','$values')";
                    $cls_conn->write_base($sqlItem);
                }  
        
                if($price == $numberlen){
                    $booleanCheckNumber = true;
                }
            }    
        endforeach;
    }else{
        if($totalprice != 0){
            $datareturn = "Error2";
        }else{
            $datareturn = "Error3";
        }
    }
}else{
    $datareturn = "Error1";
}
echo $datareturn;
?>