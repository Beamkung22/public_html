<?php
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');

$change_language=new change_language; 
$rowIdDate = $_SESSION['rowId_date'];

if(!isset($_SESSION['changenumber_setting'])){
    $_SESSION['changenumber_setting'] = "off";
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    if(isset($_POST['numberall']) && isset($_POST['price']) && $_POST['numberall'] != "" && $_POST['price'] != "" && $_POST['typen'] != ""){
        if($action == "add"){
            $rowNumber = $_POST['numberall'];
            if(!$_SESSION['Type2']){
                $typeNumber = $_POST['typen'];
                $sqlNumberAll="select p.* from lotto_product p where p.name = '$rowNumber' and p.type = '$typeNumber' and p.time_id = '$rowIdDate'";
            }else{
                $sqlNumberAll="select p.* from lotto_product p where p.name = '$rowNumber' and p.type in ('H2','L2') and p.time_id = '$rowIdDate'";
            }
            $priceEdit = $_POST['price'];
            $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
            while($numberAll=mysqli_fetch_array($rsuNumAll)){
                $dataEdit = $numberAll['name']."|".$numberAll['type'];
                $number = $numberAll['name'];
                $typeNumber = $numberAll['type'];
                if($_SESSION['changenumber_setting'] == "on" || $_SESSION['T_changenumber'] == "on"){
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
                        $checkInarray = null;
                        if(isset($_SESSION["data"])){ 
                            $dataEdit = $numberset."|".$numberAll['type'];
                            $checkInarray = array_search($dataEdit, $_SESSION["data"]);
                            if((string)$checkInarray != ""){
                                $_SESSION['dataEdit'][$checkInarray] = $priceEdit;
                            }
                        }
                        if((string)$checkInarray == ""){
                            if(isset($_SESSION['intLineItem']) || $_SESSION['intLineItem'] == "0" || $_SESSION['intLineItem'] > 0){
                                $_SESSION['intLineItem']++;
                            }else{
                                $_SESSION['intLineItem']=0;
                            }
                            $line = $_SESSION['intLineItem'];
                            
                            $sqlNumber="select p.row_id from lotto_product p where p.name = '$numberset' and p.type = '$typeNumber' and p.time_id = '$rowIdDate'";
                            $rsuNum=$cls_conn->select_base($sqlNumber);
                            $numberSelect=mysqli_fetch_array($rsuNum);
    
                            $_SESSION['data'][$line] = $numberset."|".$numberAll['type'];
                            $_SESSION['number'][$line] = $numberset;
                            $_SESSION['type'][$line] = $change_language->change_type($numberAll['type']);
                            $_SESSION['dataEdit'][$line] = $priceEdit;
                            $_SESSION['dataOld'][$line] = $numberAll['price'];
                            $_SESSION['rowId'][$line] = $numberSelect['row_id'];
                        }
                    }
                }else{
                    $checkInarray = null;
                    if(isset($_SESSION["data"])){ 
                        $checkInarray = array_search($dataEdit, $_SESSION["data"]);
                        if((string)$checkInarray != ""){
                            $_SESSION['dataEdit'][$checkInarray] = $priceEdit;
                        }
                    }
                    if((string)$checkInarray == ""){
                        if(isset($_SESSION['intLineItem']) || $_SESSION['intLineItem'] == "0" || $_SESSION['intLineItem'] > 0){
                            $_SESSION['intLineItem']++;
                        }else{
                            $_SESSION['intLineItem']=0;
                        }
                        $line = $_SESSION['intLineItem'];
                        $_SESSION['data'][$line] = $numberAll['name']."|".$numberAll['type'];
                        $_SESSION['number'][$line] = $numberAll['name'];
                        $_SESSION['type'][$line] = $change_language->change_type($numberAll['type']);
                        $_SESSION['dataEdit'][$line] = $priceEdit;
                        $_SESSION['dataOld'][$line] = $numberAll['price'];
                        $_SESSION['rowId'][$line] = $numberAll['row_id'];
                    }
                }
            }
        }
    }
    if($action == "del"){
        $rowNumber = null;
        $oneonly= true;
        if(isset($_POST['IdDel'])){
            $rowNumber = $_POST['IdDel'];
        }
        if($rowNumber == null 
                && isset($_POST['numberall']) 
                && isset($_POST['typen']) 
                && $_POST['numberall'] != "" 
                && $_POST['typen'] != ""){
                    $number = $_POST['numberall'];
                    if($_SESSION['changenumber_setting'] == "on" || $_SESSION['T_changenumber'] == "on"){
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
                        $oneonly=false;
                        if($_POST['typen'] == "H2-L2"){
                            foreach($datachange as $key => $numberset){
                                foreach($_SESSION['dataEdit'] as $key => $one) {  
                                    if($_SESSION['number'][$key] == $numberset){
                                        unset($_SESSION['dataEdit'][$key]);
                                        unset($_SESSION['dataOld'][$key]);
                                        unset($_SESSION['number'][$key]);
                                        unset($_SESSION['type'][$key]);
                                        unset($_SESSION['data'][$key]);
                                        unset($_SESSION['rowId'][$key]);
                                    }
                                }
                            }
                        }else{
                            foreach($datachange as $key => $numberset){
                                foreach($_SESSION['dataEdit'] as $key => $one) {  
                                    if($_SESSION['number'][$key] == $numberset 
                                    && $_SESSION['type'][$key] == $change_language->change_type($_POST['typen'])){
                                        $rowNumber = $key;
                                        echo $rowNumber."<br>";
                                        break;
                                    }
                                }
                                unset($_SESSION['dataEdit'][$rowNumber]);
                                unset($_SESSION['dataOld'][$rowNumber]);
                                unset($_SESSION['number'][$rowNumber]);
                                unset($_SESSION['type'][$rowNumber]);
                                unset($_SESSION['data'][$rowNumber]);
                                unset($_SESSION['rowId'][$rowNumber]);
                            }
                        }
                    }else{
                        foreach($_SESSION['dataEdit'] as $key => $one) {  
                            if($_SESSION['number'][$key] == $_POST['numberall']){
                                if($_POST['typen'] == "H2-L2"){
                                    $oneonly=false;
                                    if($_SESSION['type'][$key] == $change_language->change_type("H2")){
                                        $rowNumber = $key;
                                    }else if($_SESSION['type'][$key] == $change_language->change_type("L2")){
                                        $rowNumber = $key;
                                    }
                                    unset($_SESSION['dataEdit'][$rowNumber]);
                                    unset($_SESSION['dataOld'][$rowNumber]);
                                    unset($_SESSION['number'][$rowNumber]);
                                    unset($_SESSION['type'][$rowNumber]);
                                    unset($_SESSION['data'][$rowNumber]);
                                    unset($_SESSION['rowId'][$rowNumber]);
                                    continue;
                                }else{
                                    if($_SESSION['type'][$key] == $change_language->change_type($_POST['typen'])){
                                        $rowNumber = $key;
                                        break;
                                    }
                                }
                            }
                        }
                    } 
        }
        if($oneonly){
            if($_SESSION['type'][$rowNumber] == $change_language->change_type("T3")){
                $number = $_SESSION['number'][$rowNumber];
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
                $oneonly=false;
                foreach($datachange as $key => $numberset){
                    foreach($_SESSION['dataEdit'] as $keyz => $one) {  
                        if($_SESSION['number'][$keyz] == $numberset
                        && $_SESSION['type'][$keyz] == $change_language->change_type("T3")){
                            $rowNumber = $keyz;
                            break;
                        }
                    }
                    unset($_SESSION['dataEdit'][$rowNumber]);
                    unset($_SESSION['dataOld'][$rowNumber]);
                    unset($_SESSION['number'][$rowNumber]);
                    unset($_SESSION['type'][$rowNumber]);
                    unset($_SESSION['data'][$rowNumber]);
                    unset($_SESSION['rowId'][$rowNumber]);
                }
            }else{
                if(($_SESSION['type'][$rowNumber] == $change_language->change_type("H2"))
                || ($_SESSION['type'][$rowNumber] == $change_language->change_type("L2"))){
                    $number = $_SESSION['number'][$rowNumber];
                    foreach($_SESSION['number'] as $keyz => $one) {  
                        if($one == $number){
                            unset($_SESSION['dataEdit'][$keyz]);
                            unset($_SESSION['dataOld'][$keyz]);
                            unset($_SESSION['number'][$keyz]);
                            unset($_SESSION['type'][$keyz]);
                            unset($_SESSION['data'][$keyz]);
                            unset($_SESSION['rowId'][$keyz]);
                        }
                    }
                }else{
                    unset($_SESSION['dataEdit'][$rowNumber]);
                    unset($_SESSION['dataOld'][$rowNumber]);
                    unset($_SESSION['number'][$rowNumber]);
                    unset($_SESSION['type'][$rowNumber]);
                    unset($_SESSION['data'][$rowNumber]);
                    unset($_SESSION['rowId'][$rowNumber]);
                }
            }
        }
    }
}
if(isset($_SESSION["data"])){ 
    ?>
<div class="x_panel">
    <div class="x_title">
        <h2>Basic Tables <small>basic table subtitle</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                        class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <table class="table">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>เลข</th>
                    <th>ค่าตอบแทนที่แก้ไข</th>
                    <th>ค่าตอบแทนเดิม</th>
                    <th>ประเภทเลข</th>
                    <th>ลบข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $numrow = 1;
    foreach($_SESSION['dataEdit'] as $key => $one) {
            echo "<tr> <th>".$numrow."</th> <td>" .$_SESSION['number'][$key]. "</td>  <td>" .number_format($_SESSION['dataEdit'][$key]). " ฿ </td> <td> " .number_format($_SESSION['dataOld'][$key]). " ฿ </td> <td> " .$_SESSION['type'][$key]. " </td> <td style='text-align: center;'><a onclick='delNumber(".$key.")'><i class='fa fa-minus-square' ></i></a></td> </tr>";
            $numrow++;
    }
    ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
}
?>