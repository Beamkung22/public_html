<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$configid = $_POST['configid'];

$lotto_val1 = $_POST['lotto_val1'];
$lotto_val2 = $_POST['lotto_val2'];
$lotto_val3 = $_POST['lotto_val3'];
$lotto_val4 = $_POST['lotto_val4'];
$lotto_val5 = $_POST['lotto_val5'];
$active_flg = $_POST['active_flg'];

if($configid != ''){
    $sqlUpdateConfig=" update lotto_config set ";
    if($active_flg != ''){
        $sqlUpdateConfig.="active_flg='$active_flg' ";
    }
    if($lotto_val1 != ''){
        $sqlUpdateConfig.=",lotto_val1='$lotto_val1' ";
    }
    if($lotto_val2 != ''){
        $sqlUpdateConfig.=",lotto_val2='$lotto_val2' ";
    }
    if($lotto_val3 != ''){
        $sqlUpdateConfig.=",lotto_val3='$lotto_val3' ";
    }
    if($lotto_val4 != ''){
        $sqlUpdateConfig.=",lotto_val4='$lotto_val4' ";
    }
    if($lotto_val5 != ''){
        $sqlUpdateConfig.=",lotto_val5='$lotto_val5' ";
    }
    $sqlUpdateConfig.="where row_id='$configid' ";
    $cls_conn->write_base($sqlUpdateConfig);
}
?>