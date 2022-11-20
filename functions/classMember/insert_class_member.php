<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$status = "Error";
if(isset($_POST['classname'])){
    $classname = $_POST['classname'];
}
if(isset($_POST['grossProfit'])){
    $grossProfit = $_POST['grossProfit'];
}
if($classname != '' && $grossProfit != ''){
    $sqlClass = "INSERT INTO `class` (`row_id`, `name`, `grossProfit`) VALUES ";
    $sqlClass.= "(UUID(), '$classname','$grossProfit')";
    $cls_conn->write_base($sqlClass);
    $status = "Success";
}
echo $status;
?>
