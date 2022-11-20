<?php 
session_start();
if(isset($_POST['pagenum']) && $_POST['pagenum'] != ""){
    $_SESSION['currentpage'] = $_POST['pagenum'];
}else{
    unset($_SESSION['currentpage']);
}
if(isset($_POST['typecurrent']) && $_POST['typecurrent'] != ""){
    $_SESSION['currenttype'] = $_POST['typecurrent'];
}else{
    unset($_SESSION['currenttype']);
}
if(isset($_POST['lennum']) && $_POST['lennum'] != ""){
    $_SESSION['currentlen'] = $_POST['lennum'];
}else{
    unset($_SESSION['currentlen']);
}
?>