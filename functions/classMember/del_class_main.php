<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
if(isset($_POST['rowIdMain'])){
    $rowIdMain = $_POST['rowIdMain'];
}
$status = "Error";
if($rowIdMain != '')
    {
        $sqlClassAll="select m.* from member m where m.class = '$rowIdMain' ";
        $numrsdAll=$cls_conn->select_numrows($sqlClassAll);
        if($numrsdAll > 0){
            $status = "Error1";
        }else{
            $sql=" DELETE FROM class";
                                  $sql.=" where";
                    $sql.=" row_id='$rowIdMain'";
                    if($cls_conn->write_base($sql)==true)
                    {
                        $status = "Success";
                    }
        }
    }
echo $status;
?>
