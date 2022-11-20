<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
if(isset($_POST['price']) && $_POST['price'] != ""){
    $priceInput = $_POST['price'];
}else{
    $priceInput = 0;
}                              
if(isset($_POST['action'])){
    if($_POST['action'] == "add"){
        if(isset($_POST['number'])){
            $number = $_POST['number'];
            if($_SESSION['changenumber'] == "on"){
                $number1 = null;
                $number2 = null;
                $number3 = null;
                $number4 = null;
                $number5 = null;
                $number6 = null;
                
                $datachange = array();

                $sizenumber = strlen($number);
                
                if($sizenumber == 2){
                    $number1 = substr($number,0,1).substr($number,1,1);
                    $number2 = substr($number,1,1).substr($number,0,1);
                    //set array
                    if($number2 != $number1){
                        array_push($datachange,$number1,$number2);
                    }else{
                        array_push($datachange,$number1);
                    }
                }else if($sizenumber == 3){
                    //010
                    $number1 = substr($number,0,1).substr($number,1,1).substr($number,2,1);
                    //001
                    $number2 = substr($number,0,1).substr($number,2,1).substr($number,1,1);
                    //100
                    $number3 = substr($number,1,1).substr($number,2,1).substr($number,0,1);                   
                    //010
                    $number4 = substr($number,2,1).substr($number,1,1).substr($number,0,1);
                    //100
                    $number5 = substr($number,1,1).substr($number,0,1).substr($number,2,1);
                    //001
                    $number6 = substr($number,2,1).substr($number,0,1).substr($number,1,1);
                    //set array
                    if($number1 == $number2 && $number1 == $number3 
                    && $number1 == $number4 && $number1 == $number5 
                    && $number1 == $number6 ){
                        array_push($datachange,$number1);
                    }else if($number1 == $number2 && $number3 == $number4 
                    && $number5 == $number6 && $number2 != $number3 
                    && $number4 != $number5 ){
                        array_push($datachange,$number1,$number3,$number5);
                    }else if($number1 == $number5 && $number2 == $number3
                    && $number4 == $number6 && $number5 != $number2 
                    && $number3 != $number4 ){
                        array_push($datachange,$number1,$number2,$number4);
                    }else if($number1 == $number4 && $number2 == $number6
                    && $number3 == $number5 && $number4 != $number2 
                    && $number6 != $number3 ){
                        array_push($datachange,$number1,$number2,$number3);
                    }else{
                        array_push($datachange,$number1,$number2,$number3,$number4,$number5,$number6);
                    }
                }
            }
            if(isset($datachange) && sizeof($datachange) > 0){
                foreach($datachange as $key => $numberset){
                    if(isset($_SESSION['intLinecast']) && $_SESSION['intLinecast'] != ""){
                        $_SESSION['intLinecast']++;
                    }else{
                        $_SESSION['intLinecast']='0';
                    }
                    $cast_num = $_SESSION['intLinecast'];
                    $typenumber = $_POST['typenumber'];
                    
                    $sqlNumberAll="select p.* from lotto_product p where p.name = '$numberset' and p.type = '$typenumber' and p.time_id = '$rowIdTime'";
                    $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
                    $numberAll=mysqli_fetch_array($rsuNumAll);
                    if(isset($priceInput) && $priceInput != 0){    
                        $totalprice = $priceInput*$numberAll['price'];
                    }else{
                        $totalprice = 0;
                    }
                    $dataEdit = $numberset."|".$typenumber;
                    $checkInarray = null;
                    if(isset($_SESSION["datainput"])){ 
                        $checkInarray = array_search($dataEdit, $_SESSION["datainput"]);
                    }

                    if((string)$checkInarray == ""){
                        $_SESSION['typenumber'][$cast_num] = $typenumber;
                        $_SESSION['totalprice'][$cast_num] = $totalprice;
                        $_SESSION['inputprice'][$cast_num] = $priceInput;
                        $_SESSION['numbercast'][$typenumber][$cast_num] = $numberset;
                        $_SESSION['datainput'][$cast_num] = $dataEdit;
                    }
                }
            }else{
                if(isset($_SESSION['intLinecast']) && $_SESSION['intLinecast'] != ""){
                    $_SESSION['intLinecast']++;
                }else{
                    $_SESSION['intLinecast']='0';
                }
                $cast_num = $_SESSION['intLinecast'];
                $typenumber = $_POST['typenumber'];
                
                $sqlNumberAll="select p.* from lotto_product p where p.name = '$number' and p.type = '$typenumber' and p.time_id = '$rowIdTime'";
                $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
                $numberAll=mysqli_fetch_array($rsuNumAll);
                if(isset($priceInput) && $priceInput != 0){    
                    $totalprice = $priceInput*$numberAll['price'];
                }else{
                    $totalprice = 0;
                }
                $dataEdit = $number."|".$typenumber;
                $checkInarray = null;
                if(isset($_SESSION["datainput"])){ 
                    $checkInarray = array_search($dataEdit, $_SESSION["datainput"]);
                }
                if((string)$checkInarray == ""){
                    $_SESSION['typenumber'][$cast_num] = $typenumber;
                    $_SESSION['totalprice'][$cast_num] = $totalprice;
                    $_SESSION['inputprice'][$cast_num] = $priceInput;
                    $_SESSION['numbercast'][$typenumber][$cast_num] = $number;
                    $_SESSION['datainput'][$cast_num] = $dataEdit;
                }
            }
        }
    }else if($_POST['action'] == "del"){
        $number = $_POST['number'];
        if($_SESSION['changenumber'] == "on"){
            $number1 = null;
            $number2 = null;
            $number3 = null;
            $number4 = null;
            $number5 = null;
            $number6 = null;
            
            $datachange = array();
            
            $sizenumber = strlen($number);    
            if($sizenumber == 2){
                $number1 = substr($number,0,1).substr($number,1,1);
                $number2 = substr($number,1,1).substr($number,0,1);
                //set array
                if($number2 != $number1){
                    array_push($datachange,$number1,$number2);
                }else{
                    array_push($datachange,$number1);
                }
            }else if($sizenumber == 3){
                //010
                $number1 = substr($number,0,1).substr($number,1,1).substr($number,2,1);
                //001
                $number2 = substr($number,0,1).substr($number,2,1).substr($number,1,1);
                //100
                $number3 = substr($number,1,1).substr($number,2,1).substr($number,0,1);                   
                //010
                $number4 = substr($number,2,1).substr($number,1,1).substr($number,0,1);
                //100
                $number5 = substr($number,1,1).substr($number,0,1).substr($number,2,1);
                //001
                $number6 = substr($number,2,1).substr($number,0,1).substr($number,1,1);
                //set array
                if($number1 == $number2 && $number1 == $number3 
                && $number1 == $number4 && $number1 == $number5 
                && $number1 == $number6 ){
                    array_push($datachange,$number1);
                }else if($number1 == $number2 && $number3 == $number4 
                && $number5 == $number6 && $number2 != $number3 
                && $number4 != $number5 ){
                    array_push($datachange,$number1,$number3,$number5);
                }else if($number1 == $number5 && $number2 == $number3
                && $number4 == $number6 && $number5 != $number2 
                && $number3 != $number4 ){
                    array_push($datachange,$number1,$number2,$number4);
                }else if($number1 == $number4 && $number2 == $number6
                && $number3 == $number5 && $number4 != $number2 
                && $number6 != $number3 ){
                    array_push($datachange,$number1,$number2,$number3);
                }else{
                    array_push($datachange,$number1,$number2,$number3,$number4,$number5,$number6);
                }
            }
        }
        if(isset($datachange) && sizeof($datachange) > 0){
            foreach($datachange as $key => $numberset){
                if(isset($_SESSION['numbercast'])){
                    foreach($_SESSION['numbercast'] as $key => $type) {
                        if($key == $_POST['typenumber']){
                            if(sizeof($_SESSION['numbercast'][$key]) > 0){
                                foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
                                    if($value == $numberset){
                                        unset($_SESSION['numbercast'][$key][$keyvalue]);
                                        unset($_SESSION['typenumber'][$keyvalue]);
                                        unset($_SESSION['totalprice'][$keyvalue]);
                                        unset($_SESSION['inputprice'][$keyvalue]);
                                        unset($_SESSION['datainput'][$keyvalue]);
                                    }
                                }
                                if(sizeof($_SESSION['numbercast'][$key]) == 0){
                                    unset($_SESSION['numbercast'][$key]);
                                }
                            }
                        }
                    }
                }
            }
        }else{
            if(isset($_SESSION['numbercast'])){
                foreach($_SESSION['numbercast'] as $key => $type) {
                    if($key == $_POST['typenumber']){
                        if(sizeof($_SESSION['numbercast'][$key]) > 0){
                            foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
                                if($value == $_POST['number']){
                                    unset($_SESSION['numbercast'][$key][$keyvalue]);
                                    unset($_SESSION['typenumber'][$keyvalue]);
                                    unset($_SESSION['totalprice'][$keyvalue]);
                                    unset($_SESSION['inputprice'][$keyvalue]);
                                    unset($_SESSION['datainput'][$keyvalue]);
                                }
                            }
                            if(sizeof($_SESSION['numbercast'][$key]) == 0){
                                unset($_SESSION['numbercast'][$key]);
                            }
                        }
                    }
                }
            }
        }
    }else if($_POST['action'] == "delone"){
        if(isset($_POST['rownumber']) && $_POST['rownumber'] != ""){
            $numrow = $_POST['rownumber'];
            $type = $_POST['typenumber'];
            
            unset($_SESSION['numbercast'][$type][$numrow]);
            unset($_SESSION['typenumber'][$numrow]);
            unset($_SESSION['totalprice'][$numrow]);
            unset($_SESSION['inputprice'][$numrow]);
            unset($_SESSION['datainput'][$numrow]);

            if(sizeof($_SESSION['numbercast'][$type]) == 0){
                unset($_SESSION['numbercast'][$type]);
            }
        }
    }else if($_POST['action'] == "count"){
        if(isset($_POST['number'])){
            $number = $_POST['number'];
            $typenumber = $_POST['typenumber'];
            foreach($_SESSION['numbercast'] as $key => $type) {
                if($typenumber ==  $key){
                    foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
                        if($number == $value){
                            $sqlNumberAll="select p.* from lotto_product p where p.name = '$number' and p.type = '$typenumber' and p.time_id = '$rowIdTime'";
                            $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
                            $numberAll=mysqli_fetch_array($rsuNumAll);
                            if(isset($priceInput) && $priceInput != 0){    
                                $totalprice = $priceInput*$numberAll['price'];
                            }else{
                                $totalprice = 0;
                            }
                
                            $_SESSION['totalprice'][$keyvalue] = $totalprice;
                            $_SESSION['inputprice'][$keyvalue] = $priceInput;
                        }
                    }
                }
            }
        }
    }
}
$typecurrent = '';
$lencurrent = '';
$pagecurrent = '';
if(isset($_SESSION['currenttype']) && $_SESSION['currenttype'] != ''){
    $typecurrent = $_SESSION['currenttype'];
}
if(isset($_SESSION['currentlen']) && $_SESSION['currentlen'] != ''){
    $lencurrent = $_SESSION['currentlen'];
}
if(isset($_SESSION['currentpage']) && $_SESSION['currentpage'] != ''){
    $pagecurrent = $_SESSION['currentpage'];
}

if(isset($_SESSION['numbercast'])){
    foreach($_SESSION['numbercast'] as $key => $type) {
        ?><span class="section"><?php echo $change_language->change_type($key); ?></span><?php
        foreach($_SESSION['numbercast'][$key] as $keyvalue => $value) {
    ?>
        <div class="mail_list">
                            <div class="left">
                              <a onclick="clearonecast('<?php echo $keyvalue; ?>','<?php echo $key; ?>','<?php echo $typecurrent; ?>','<?php echo $lencurrent; ?>','<?php echo $pagecurrent; ?>');"><i class="fa fa-times"></i></a>
                            </div>
                            <div class="right">
                              <h3><?php echo $value;?> <small>ราคา <input type="number" value="<?php echo $_SESSION['inputprice'][$keyvalue]; ?>" onchange="changetotalprice(<?php echo 'this,\''.$value.'\',\''.$key.'\''; ?>)" /> บาท</small></h3>
                              <p>เงินรางวัล = <?php echo $_SESSION['totalprice'][$keyvalue]; ?> บาท</p>
                            </div>
                          </div>
    <?php
        }
    }
}
?>