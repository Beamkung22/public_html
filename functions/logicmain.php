<?php
session_start();
class change_language{
    public function change_Status($Status){
        $StatusName = "";
        if($Status == "Pending"){
            $StatusName = "รอการอนุมัติรายการ";
        }else if($Status == "Cancel"){
            $StatusName = "ยกเลิกการทำรายการ";
        }else if($Status == "Complete"){
            $StatusName = "อนุมัติรายการเสร็จสิ้น";
        }
        return $StatusName;
    }
    public function change_type($type){
        $StatusName = "";
        if($type == "H2"){
            $StatusName = "บน2";
        }else if($type == "L2"){
            $StatusName = "ล่าง2";
        }else if($type == "H3"){
            $StatusName = "บน3";
        }else if($type == "L3"){
            $StatusName = "ล่าง3";
        }else if($type == "T3"){
            $StatusName = "โต๊ด";
        }else if($type == "H1"){
            $StatusName = "บน1";
        }else if($type == "L1"){
            $StatusName = "ล่าง1";
        } 
        return $StatusName;
    }
    public function change_Status_listplay($Status){
        $StatusName = "";
        if($Status == "Pending"){
            $StatusName = "ยังไม่ได้เปิดรางวัล";
        }else if($Status == "Cancel"){
            $StatusName = "ยกเลิกการเดิมพัน";
        }else if($Status == "Lost"){
            $StatusName = "ไม่ถูกรางวัล";
        }else if($Status == "Win"){
            $StatusName = "ถูกรางวัล";
        }
        return $StatusName;
    }
    public function change_Status_member($Status){
        $StatusName = "";
        if($Status == "admin"){
            $StatusName = "ผู้ดูแลระบบ";
        }else if($Status == "dealer"){
            $StatusName = "ตัวแทนขาย";
        }else if($Status == "customer"){
            $StatusName = "ลูกค้า";
        }
        return $StatusName;
    }
    public function change_Config_Type($Config){
        $StatusName = "";
        if($Config == "status_user"){
            $StatusName = "สถานะบุคคล";
        }else if($Config == "price_project"){
            $StatusName = "ราคาจ่ายเริ่มต้น";
        }else if($Config == "time_cancel"){
            $StatusName = "เวลายกเลิกรายการ";
        }else if($Config == "project_default_buy"){
            $StatusName = "ราคาเริ่มต้นขาย";
        }
        return $StatusName;
    }
    public function change_type_data($type){
        $StatusName = "";
        if($type == "2บน"){
            $StatusName = "H2";
        }else if($type == "2ล่าง"){
            $StatusName = "L2";
        }else if($type == "3บน"){
            $StatusName = "H3";
        }else if($type == "3ล่าง"){
            $StatusName = "L3";
        }else if($type == "โต๊ด"){
            $StatusName = "T3";
        }else if($type == "วิ่งบน"){
            $StatusName = "H1";
        }else if($type == "วิ่งล่าง"){
            $StatusName = "L1";
        }
        return $StatusName;
    }
}

class color_status{
    public function status_listplay($Status){
        $color = "";
        if($Status == "Pending"){
            $color = "#EF820D";
        }else if($Status == "Cancel"){
            $color = "Gray";
        }else if($Status == "Lost"){
            $color = "Red";
        }else if($Status == "Win"){
            $color = "Green";
        }
        return $color;
    }
}

class gen_numberNo{
    public function gen_user($cls_conn,$rowIdTime){
        $Ucode = "";
        for($i = 0; $i < 999999999; $i++){
            $Ucode = sprintf('U%09d', rand(0,999999999)); 
            $sqlItem_pro=" SELECT * FROM `lotto_item_user` WHERE numberNo = '$Ucode' and time_id = '$rowIdTime' ";
            $numrow=$cls_conn->select_numrows($sqlItem_pro);
            if($numrow <= 0){
                break;
            }
        }
        return $Ucode;
    }
}
include('session_timeout.php');
//คำนวนเลข Order
$orderNo = "L".date('U');
$orderNo_Dealer = "D".date('U');
$orderNo_User = "U".date('U');
$datetimeU = date('U');

$dateTimeCur = new DateTime('now', new DateTimeZone('Asia/Bangkok')); 
$StrdateCur =  $dateTimeCur->format("m/d/y  H:i A");
$StrdateCurChk =  date("Y-m-d H:i:s",strtotime($dateTimeCur->format("Y-m-d H:i:s")));

$dateTimeTo= date_add($dateTimeCur, date_interval_create_from_date_string('3 days')); 
$StrdateTo = $dateTimeTo->format("m/d/y  H:i A"); 
$Strdate = $StrdateCur . " - " . $StrdateTo;
$rowIdTime = "";
//Check เปิดรอบ
$memberlogin = $_SESSION['id_member'];

$query = "SELECT m.*,lc.lotto_name FROM member m , lotto_config lc WHERE m.row_id = '$memberlogin' and lc.active_flg = 'Y' and m.status = lc.row_id";
$list=$cls_conn->select_base($query);
$row = mysqli_fetch_array($list);
$_SESSION['status'] = $row['lotto_name'];
$_SESSION['name'] = $row['name'];
$_SESSION['price_member'] = $row['credit'];

//Check เปิดรอบ
$sqlTimeOpen="select t.row_id from lotto_time t where t.status = 'Pending' and DATE_FORMAT('".$StrdateCurChk."', '%Y-%m-%d %T') BETWEEN t.time_open AND t.time_close";
$rsdTimeOpen=$cls_conn->select_base($sqlTimeOpen);
while($timeOpen=mysqli_fetch_array($rsdTimeOpen))
{ 
    $rowIdTime = $timeOpen['row_id'];
    $sqlUpdateStatus=" update lotto_time t set t.status='Open' where t.row_id='$rowIdTime'";
    $cls_conn->write_base($sqlUpdateStatus);
}
//Check รอบที่กำลังเปิดอยู่
if($rowIdTime == ""){
    $sqlTimeIn=" select t.* from lotto_time t where t.status = 'Open' and DATE_FORMAT('".$StrdateCurChk."', '%Y-%m-%d %T') BETWEEN t.time_open AND t.time_close";
    $rsdTimeIn=$cls_conn->select_base($sqlTimeIn);
    while($timeIn=mysqli_fetch_array($rsdTimeIn))
    { 
        $rowIdTime = $timeIn['row_id'];
    }
}
//Check ปิดรอบ
$sqlTimeClose=" select t.* from lotto_time t where t.status = 'Open' ";
$rsdTimeClose=$cls_conn->select_base($sqlTimeClose);
while($timeClose=mysqli_fetch_array($rsdTimeClose))
{ 
    $dateTimeEnd = new DateTime($timeClose["time_close"],new DateTimeZone('Asia/Bangkok'));
    $StrdateEnd =  date("Y-m-d H:i:s",strtotime($dateTimeEnd->format("Y-m-d H:i:s")));
    if($StrdateCurChk >= $StrdateEnd){
        $rowIdTime = $timeClose['row_id'];
        $sqlUpdateStatus=" update lotto_time t set t.status='Close' where t.row_id='$rowIdTime'";
        $cls_conn->write_base($sqlUpdateStatus);
        $rowIdTime = "";
    }
}
$timeConfig = 0;
$sqlConfigTimeCancel=" select lc.* from lotto_config lc where lc.lotto_type = 'time_cancel' and lc.active_flg = 'Y' ";
    $rsdConfigTimeCancel=$cls_conn->select_base($sqlConfigTimeCancel);
    while($timeConfigTimeCancel=mysqli_fetch_array($rsdConfigTimeCancel))
    { 
        $timeConfig = $timeConfigTimeCancel['lotto_val1'];
    }
?>