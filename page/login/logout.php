<?php 
include('../../connect/class_conn.php');
session_start();
$cls_conn=new class_conn; 
session_destroy(); //destroy the session
echo $cls_conn->goto_page(1,'/');
exit();
?>