<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$status = "Error";
if(isset($_POST['grossProfit'])){
    $grossProfit = $_POST['grossProfit'];
}
if(isset($_POST['rowIdMain'])){
    $rowIdMain = $_POST['rowIdMain'];
}
if(isset($_POST['nameClass'])){
    $nameClass = $_POST['nameClass'];
}
if($rowIdMain != '' && $grossProfit != ''){
    $sqlUpdateMain=" update class set ";
    $sqlUpdateMain.=" grossProfit='$grossProfit' , ";
    $sqlUpdateMain.=" name='$nameClass' ";
    $sqlUpdateMain.="where row_id='$rowIdMain' ";
    $cls_conn->write_base($sqlUpdateMain);
    $status = "Success";
}
echo $status;
?>
