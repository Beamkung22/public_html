<?php 
include('../../connect/class_conn.php');
session_start();
$cls_conn=new class_conn;
//check Number Error
$numrow = 0;
$type = $_POST['typenumber'];
if($type == null){
exit;
}
if($_POST['typenumber'] == "H2-L2"){
    $type = "H2";
    $_SESSION['Type2'] = true;
}else{
    $_SESSION['Type2'] = false;
}

if($_POST['typenumber'] == 'T3'){
  $_SESSION['T_changenumber'] = "on";
}else{
  $_SESSION['T_changenumber'] = "off";
}
$pagenum = 1;
if(isset($_POST['pagenum']) && 
$_POST['pagenum'] != ""){
  $pagenum = $_POST['pagenum'];
}
$rowIdTime = $_SESSION['rowId_date'];
$sqlNumberAll="select p.* from lotto_product p where p.type = '$type' and p.time_id = '$rowIdTime' Order By p.name ASC ";
$rsdAll=$cls_conn->select_base($sqlNumberAll);
while($NumAll=mysqli_fetch_array($rsdAll))
{
    $numrow++;
    if($numrow == 1){
        $pageKeyName = $NumAll['name'];
        //$pageName[$pagenum] = $item_pro['name']
    } 
    $pageDataShow[$pageKeyName][$numrow] = $NumAll['name'];
    $pageflagfix[$pageKeyName][$numrow] = $NumAll['flag_fix'];
    $pagenumberfix[$pageKeyName][$numrow] = $NumAll['price_fix'];
    if($numrow == 100){
        $numrow = 0;
        $pageKeyName = "";
    }
}
?>
<div id="datanumber" style="width:100%;" class="center" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
        <?php 
                        $num = 0;
                        foreach($pageDataShow as $key => $one) {
                        $num++; ?>
        <li role="presentation" <?php if($num == $pagenum){ echo "class='active'"; }else{ echo "class=''";} ?>><a
                href="#tab_content<?php echo $num; ?>" id="home-tab" role="tab" data-toggle="tab"
                aria-expanded="true"><?php echo $key; ?></a>
        </li>
        <?php } ?>
    </ul>
    <div id="myTabContent" class="tab-content">
        <?php 
                        $numValue = 0;
                          foreach($pageDataShow as $key => $one) {
                            $numValue++;
                            ?>
        <div role="tabpanel"
            <?php if($numValue == $pagenum){ echo "class='tab-pane fade active in'"; }else{ echo "class='tab-pane fade'";} ?>
            id="tab_content<?php echo $numValue; ?>" aria-labelledby="home-tab">
            <?php
                            foreach($pageDataShow[$key] as $keys => $value) {
                              //if ($pageflagfix[$key][$keys] == "N" 
                              //    ||  ($pageflagfix[$key][$keys] == "Y" && $pagenumberfix[$key][$keys] > 0)){
                              //echo $keys;
                              
                              ?>
            <input type="checkbox" name="A" class="a" value="<?php echo $value; ?>"
                onclick="editNumber(this,'<?php echo $numValue; ?>')"
                <?php if(isset($_SESSION['number'])){ foreach($_SESSION['number'] as $numkey => $typeaa) { if($cls_conn->change_type_data($_SESSION['type'][$numkey]) == $type){ if($_SESSION['number'][$numkey] == $value){ echo 'checked';  } } } }?> />
            <?php
                              //}
                            }
                            ?>
        </div>
        <?php
                          }
                        ?>
    </div>
</div>