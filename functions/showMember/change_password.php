<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../functions.php');
include('../logicmain.php');
$change_language=new change_language;
$passwordnew = $_POST['passwordnew'];
$idMember = $_POST['idMember'];
$datareturn = "Error";
    if($passwordnew != '' && $idMember != '')
    {
      $password = $passwordnew;
      $salt = getSalt();
              //Generate a unique password Hash
              $passwordHash = password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT); 
      $sql=" update member";
                              $sql.=" set";
                $sql.=" password='$passwordHash',";
                $sql.=" salt='$salt' ";
                              $sql.=" where";
                $sql.=" row_id='$idMember'";
                if($cls_conn->write_base($sql)==true)
                {
                    $datareturn = "Success";
                }
    }
    echo $datareturn;
  ?>