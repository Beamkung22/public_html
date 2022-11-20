<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../functions/functions.php');
include('../logicmain.php');
$change_language=new change_language;
$idMember = $_POST['idMember'];

$newname = $_POST['newname'];
$newemail = $_POST['newemail'];
$newtel = $_POST['newtel'];
$newstatus = $_POST['newstatus'];
$newclass = $_POST['newclass'];
$newaccountno = $_POST['newaccountno'];

if($idMember != ''){
    $sqlUpdateMember=" update member set ";
    if($newname != ''){
        $sqlUpdateMember.="name='$newname' ";
    }
    if($newemail != ''){
        $sqlUpdateMember.=",Email='$newemail' ";
    }
    if($newtel != ''){
        $sqlUpdateMember.=",tel='$newtel' ";
    }
    if($newstatus != ''){
        $sqlUpdateMember.=",status='$newstatus' ";
    }
    if($newclass != ''){
        $sqlUpdateMember.=",class='$newclass' ";
    }
    if($newaccountno != ''){
        $sqlUpdateMember.=",accountno='$newaccountno' ";
    }
    $sqlUpdateMember.="where row_id='$idMember' ";
    $cls_conn->write_base($sqlUpdateMember);
}
?>