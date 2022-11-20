<?php
include('../../connect/class_conn.php');
session_start();
$cls_conn=new class_conn;
$rowIdTime = $_POST['rowIdTime'];
$countChampions = 0;

$sqlChk=" select la.* from lotto_award la where la.time_id = '$rowIdTime' ";
$rsdData=$cls_conn->select_base($sqlChk);
$nums=$cls_conn->select_numrows($sqlChk);

if($nums > 0){
    $sqlDel="DELETE FROM `lotto_award` WHERE `lotto_award`.`time_id` = '$rowIdTime' ";
    $cls_conn->write_base($sqlDel);
    foreach($_POST as $key => $values) {
        $sqlAward = "";
        $type = substr($key,0,2);
        if($values != ''){
            if($key == "champions"){
                $sqlAward = "INSERT INTO `lotto_award` (`row_id`, `time_id`, `type`, `number`, `pro_id` ) VALUES ";
                $sqlAward.= "(UUID(), '$rowIdTime','C','$values','')";
            }else if($type == "H3"
            || $type == "L3"
            || $type == "T3"
            || $type == "H2"
            || $type == "L2"
            || $type == "H1"
            || $type == "L1"){
                $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$values' ";
                $sqlItem_pro.=" and p.type = '$type' ";
                $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                while($item_pro=mysqli_fetch_array($rsdItem_pro)){
                    $proId = $item_pro['row_id'];
                }
                if($proId != ''){
                    $productChampions[$countChampions] = $proId;
                    $sqlAward = "INSERT INTO `lotto_award` (`row_id`, `time_id`, `type`, `number`, `pro_id`) VALUES ";
                    $sqlAward.= "(UUID(), '$rowIdTime','$type','$values','$proId')";
                }
            }
        }
        if($sqlAward != ""){
            $cls_conn->write_base($sqlAward);
        }
        $countChampions++;
    }
}else{
    foreach($_POST as $key => $values) {
        $sqlAward = "";
        if($values != ''){
            $type = substr($key,0,2);
            if($key == "champions"){
                $sqlAward = "INSERT INTO `lotto_award` (`row_id`, `time_id`, `type`, `number`, `pro_id` ) VALUES ";
                $sqlAward.= "(UUID(), '$rowIdTime','C','$values','')";
            }else if($type == "H3"
            || $type == "L3"
            || $type == "T3"
            || $type == "H2"
            || $type == "L2"
            || $type == "H1"
            || $type == "L1"){
                $sqlItem_pro=" select p.row_id from lotto_product p where p.name = '$values' ";
                $sqlItem_pro.=" and p.type = '$type' ";
                $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                while($item_pro=mysqli_fetch_array($rsdItem_pro)){
                    $proId = $item_pro['row_id'];
                }
                if($proId != ''){
                    $productChampions[$countChampions] = $proId;
                    $sqlAward = "INSERT INTO `lotto_award` (`row_id`, `time_id`, `type`, `number`, `pro_id`) VALUES ";
                    $sqlAward.= "(UUID(), '$rowIdTime','$type','$values','$proId')";
                }
            }
        }
        if($sqlAward != ""){
            $cls_conn->write_base($sqlAward);
        }
        $countChampions++;
    }
}
//Update ListPlay
$sqlList_play=" select tu.* from lotto_item_user tu where tu.time_id = '$rowIdTime' ";
$rsdList_play=$cls_conn->select_base($sqlList_play);
while($list_play=mysqli_fetch_array($rsdList_play)){
    $listrowId = $list_play['row_id'];
    $proId = $list_play['product_id'];
    if(in_array($proId, $productChampions)){
        $sqlUpdateStatus=" update lotto_item_user tu set tu.status_cd='Win' where tu.row_id='$listrowId' ";
    }else{
        $sqlUpdateStatus=" update lotto_item_user tu set tu.status_cd='Lost' where tu.row_id='$listrowId' ";
    }
    $cls_conn->write_base($sqlUpdateStatus);
}
?>