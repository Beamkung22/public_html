<?php 
session_start();
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$numberNo = $_POST['numberNo'];
$return = "Error";
if(isset($rowIdTime) && $rowIdTime != ''){
    if(isset($_POST['numberNo'])){
        $numberNo = $_POST['numberNo'];
        $sqld=" SELECT tu.create_dt
        , tu.price
        , tu.member_id
        , tu.product_id
        , p.flag_fix
        , p.price_fix
        , m.credit
        FROM `lotto_item_user` tu
        , lotto_product p 
        , member m 
        WHERE tu.numberNo = '$numberNo'
        and tu.product_id = p.row_id
        and tu.member_id = m.row_id
        and tu.time_id = '$rowIdTime' ";
        $rsd=$cls_conn->select_base($sqld);
        $listplay=mysqli_fetch_array($rsd);
        $priceb = $listplay['price'];
        $cdate = $listplay['create_dt'];
        $cnewDate = date("Y-m-d H:i:s",strtotime($cdate." +".$timeConfig." minutes"));

        $proid = $listplay['product_id'];
        $pricefix = $listplay['price_fix'];
        $pricefix = $pricefix + $priceb;
        
        $memid = $listplay['member_id'];
        $credit = $listplay['credit'];
        $credit = $credit + $priceb;

        if($_SESSION['status'] == "admin" || $cnewDate >= $StrdateCurChk){
            //Update Statue Cancel
            $sqlUpdateStatus=" update lotto_item_user tu set tu.status_cd='Cancel' where tu.numberNo='$numberNo' and tu.time_id = '$rowIdTime' ";
            $cls_conn->write_base($sqlUpdateStatus);
            //Update คืนเงินอั้นขาย
            if($listplay['flag_fix'] == "Y"){
                $sqlUpdatePriceFix=" update lotto_product p set p.price_fix='$pricefix' where p.row_id='$proid' ";
                $cls_conn->write_base($sqlUpdatePriceFix);
            }
            //Update คืนเงินให้ลูกค้า
            $sqlUpdateCredit=" update member m set m.credit='$credit' where m.row_id='$memid'";
            $cls_conn->write_base($sqlUpdateCredit);
            $_SESSION['price_member'] = $credit;

            $return = "Success";
        }
    }
}
echo $return;
?>