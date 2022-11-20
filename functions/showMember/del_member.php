<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$idMember = $_POST['idMember'];
$datareturn = "Error";
if($idMember != '')
    {
      $sql=" DELETE FROM member";
                              $sql.=" where";
                $sql.=" row_id='$idMember'";
                if($cls_conn->write_base($sql)==true)
                {
                    $datareturn = "Success";
                }
    }
    echo $datareturn;
    ?>