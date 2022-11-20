<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$oldclass = $_POST['oldclass'];
$sqld=" select * from class ";
$rsd=$cls_conn->select_base($sqld);
while($status=mysqli_fetch_array($rsd))
{
    if($status['row_id'] == $oldclass){
?>
<option selected value="<?php echo $status['row_id']; ?>"><?php echo $status['name']; ?></option>
<?php
    }else{
?>
<option value="<?php echo $status['row_id']; ?>"><?php echo $status['name']; ?></option>
    <?php 
    }
}  
?>
