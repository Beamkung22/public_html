<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
if(isset($_POST['creditAdd'])){
    $creditAdd = $_POST['creditAdd'];
}
if(isset($_POST['creditDelete'])){
    $creditDelete = $_POST['creditDelete'];
}
$idMember = $_POST['idMember'];
$creditOld = $_POST['creditOld'];
$action = $_POST['action'];
$datareturn = "Error";
if($action != ''){
    if($action == "add"){
        if($creditAdd != '' && $creditOld != '' && $idMember != '')
        {
        $credit = $creditOld + $creditAdd;
        $sql=" update member";
                                $sql.=" set";
                    $sql.=" credit='$credit' ";
                                $sql.=" where";
                    $sql.=" row_id='$idMember'";
                    if($cls_conn->write_base($sql)==true)
                    {
                        $datareturn = "Success";
                    }
        }
    }else if($action == "del"){
        if($creditDelete != '' && $creditOld != '' && $idMember != '')
        {
        $credit = $creditOld - $creditDelete;
        $sql=" update member";
                                $sql.=" set";
                    $sql.=" credit='$credit' ";
                                $sql.=" where";
                    $sql.=" row_id='$idMember'";
                    if($cls_conn->write_base($sql)==true)
                    {
                        $datareturn = "Success";
                    }
        }
    }
}
    echo $datareturn;
    ?>