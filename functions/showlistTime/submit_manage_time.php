<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$tiemId = $_POST['idTime'];
$timeopen = $_POST['timeopen'];
$timeclose = $_POST['timeclose'];


if($tiemId != ''){
    $timeopen = date('Y-m-d H:i:s',strtotime($timeopen));
    $timeclose = date('Y-m-d H:i:s',strtotime($timeclose));
    $timecurrent = date('Y-m-d H:i:s');

    $sqlUpdateTime=" update lotto_time set ";
    $sqlUpdateTime.="time_open='$timeopen'";
    $sqlUpdateTime.=", time_close='$timeclose'";
    if($timeopen <= $timecurrent
        && $timeclose > $timecurrent){
        $sqlUpdateTime.=", status='Open'";
    }else if($timeopen > $timecurrent){
        $sqlUpdateTime.=", status='Pending'";
    }else if($timeclose <= $timecurrent){
        $sqlUpdateTime.=", status='Close'";
    }
    $sqlUpdateTime.="where row_id='$tiemId' ";
    $cls_conn->write_base($sqlUpdateTime);
}
?>