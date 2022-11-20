<?php
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');

$change_language=new change_language; 

if(!isset($_SESSION['changenumber_setting'])){
    $_SESSION['changenumber_setting'] = "off";
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    if(isset($_POST['numberallsell']) && isset($_POST['pricesell']) && $_POST['numberallsell'] != "" && $_POST['pricesell'] != "" && $_POST['typen'] != ""){
        if($action == "add"){
            $rowNumber = $_POST['numberallsell'];
            $priceEdit = $_POST['pricesell'];
            $rowIdDate = $_SESSION['rowId_date'];
            $typeNumber = $_POST['typen'];

            $sqlNumberAll="select p.* from lotto_product p where p.name = '$rowNumber' and p.type = '$typeNumber' and p.time_id = '$rowIdDate'";
            $rsuNumAll=$cls_conn->select_base($sqlNumberAll);
            $numberAll=mysqli_fetch_array($rsuNumAll);
            $dataEdit = $numberAll['name']."|".$numberAll['type'];
            $number = $numberAll['name'];
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
                    if(isset($_SESSION['intLineSell']) || $_SESSION['intLineSell'] == "0" || $_SESSION['intLineSell'] > 0){
                        $_SESSION['intLineSell']++;
                    }else{
                        $_SESSION['intLineSell']=0;
                    }
                    $line = $_SESSION['intLineSell'];
                    $checkInarray = null;
                    if(isset($_SESSION["dataSell"])){ 
                        $dataEdit = $numberset."|".$numberAll['type'];
                        $checkInarray = array_search($dataEdit, $_SESSION["dataSell"]);
                        if((string)$checkInarray != ""){
                            $_SESSION['dataEditSell'][$checkInarray] = $priceEdit;
                        }
                    }
                    if((string)$checkInarray == ""){

                        $sqlNumber="select p.row_id from lotto_product p where p.name = '$numberset' and p.type = '$typeNumber' and p.time_id = '$rowIdDate'";
                        $rsuNum=$cls_conn->select_base($sqlNumber);
                        $numberSelect=mysqli_fetch_array($rsuNum);

                        $_SESSION['dataSell'][$line] = $numberset."|".$numberAll['type'];
                        $_SESSION['numberSell'][$line] = $numberset;
                        $_SESSION['typeSell'][$line] = $change_language->change_type($numberAll['type']);
                        $_SESSION['dataEditSell'][$line] = $priceEdit;
                        if($numberAll['flag_fix'] == 'N'){
                            $_SESSION['dataOldSell'][$line] = '∞';
                        }else{
                            $_SESSION['dataOldSell'][$line] = number_format($numberAll['price_fix'])." ฿";
                        }
                        $_SESSION['rowIdSell'][$line] = $numberSelect['row_id'];
                    }
                }
            }else{
                if(isset($_SESSION['intLineSell']) || $_SESSION['intLineSell'] == "0" || $_SESSION['intLineSell'] > 0){
                    $_SESSION['intLineSell']++;
                }else{
                    $_SESSION['intLineSell']=0;
                }
                $line = $_SESSION['intLineSell'];
                $checkInarray = null;
                if(isset($_SESSION["dataSell"])){ 
                    $checkInarray = array_search($dataEdit, $_SESSION["dataSell"]);
                    if((string)$checkInarray != ""){
                        $_SESSION['dataEditSell'][$checkInarray] = $priceEdit;
                    }
                }
                if((string)$checkInarray == ""){
                    $_SESSION['dataSell'][$line] = $numberAll['name']."|".$numberAll['type'];
                    $_SESSION['numberSell'][$line] = $numberAll['name'];
                    $_SESSION['typeSell'][$line] = $change_language->change_type($numberAll['type']);
                    $_SESSION['dataEditSell'][$line] = $priceEdit;
                    if($numberAll['flag_fix'] == 'N'){
                        $_SESSION['dataOldSell'][$line] = '∞';
                    }else{
                        $_SESSION['dataOldSell'][$line] = number_format($numberAll['price_fix'])." ฿";
                    }
                    $_SESSION['rowIdSell'][$line] = $numberAll['row_id'];
                }
            }
        }
    }
    if($action == "del"){
        $rowNumber = null;
        $oneonly= true;
        if(isset($_POST['IdDelSell'])){
            $rowNumber = $_POST['IdDelSell'];
        }
        if($rowNumber == null 
                && isset($_POST['numberallsell']) 
                && isset($_POST['typen']) 
                && $_POST['numberallsell'] != "" 
                && $_POST['typen'] != ""){
                    $number = $_POST['numberallsell'];
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
                        foreach($datachange as $key => $numberset){
                            foreach($_SESSION['dataEditSell'] as $key => $one) {  
                                if($_SESSION['numberSell'][$key] == $numberset 
                                && $_SESSION['typeSell'][$key] == $change_language->change_type($_POST['typen'])){
                                    $rowNumber = $key;
                                    break;
                                }
                            }
                            unset($_SESSION['dataEditSell'][$rowNumber]);
                            unset($_SESSION['dataOldSell'][$rowNumber]);
                            unset($_SESSION['numberSell'][$rowNumber]);
                            unset($_SESSION['typeSell'][$rowNumber]);
                            unset($_SESSION['dataSell'][$rowNumber]);
                            unset($_SESSION['rowIdSell'][$rowNumber]);
                        }
                    }else{
                        foreach($_SESSION['dataEditSell'] as $key => $one) {  
                            if($_SESSION['numberSell'][$key] == $_POST['numberallsell'] 
                            && $_SESSION['typeSell'][$key] == $change_language->change_type($_POST['typen'])){
                                $rowNumber = $key;
                                break;
                            }
                        }
                    } 
        }
        if($oneonly){
            if($_SESSION['typeSell'][$rowNumber] == $change_language->change_type("T3")){
                $number = $_SESSION['numberSell'][$rowNumber];
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
                    foreach($_SESSION['dataEditSell'] as $keyz => $one) {  
                        if($_SESSION['numberSell'][$keyz] == $numberset
                        && $_SESSION['typeSell'][$keyz] == $change_language->change_type("T3")){
                            $rowNumber = $keyz;
                            break;
                        }
                    }
                    unset($_SESSION['dataEditSell'][$rowNumber]);
                    unset($_SESSION['dataOldSell'][$rowNumber]);
                    unset($_SESSION['numberSell'][$rowNumber]);
                    unset($_SESSION['typeSell'][$rowNumber]);
                    unset($_SESSION['dataSell'][$rowNumber]);
                    unset($_SESSION['rowIdSell'][$rowNumber]);
                }
            }else{
                unset($_SESSION['dataEditSell'][$rowNumber]);
                unset($_SESSION['dataOldSell'][$rowNumber]);
                unset($_SESSION['numberSell'][$rowNumber]);
                unset($_SESSION['typeSell'][$rowNumber]);
                unset($_SESSION['dataSell'][$rowNumber]);
                unset($_SESSION['rowIdSell'][$rowNumber]);
            }
        }
    }
}
if(isset($_SESSION["dataSell"])){ 
    ?>
    <div  class="x_panel">
                    <div class="x_title">
                        <h2>ตั้งค่าตัวเลข อั้นเท่าที่ขาย</h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                            <th>จำนวนราคาที่ขาย</th>
                            <th>จำนวนราคาที่ขายแทนเดิม</th> 
                            <th>ประเภทเลข</th>
                            <th>ลบข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    $numrow = 1;
    foreach($_SESSION['dataEditSell'] as $key => $one) {
            echo "<tr> <th>".$numrow."</th> <td>" .$_SESSION['numberSell'][$key]. "</td>  <td>" .number_format($_SESSION['dataEditSell'][$key]). " ฿ </td> <td> " .$_SESSION['dataOldSell'][$key]. " </td> <td> " .$_SESSION['typeSell'][$key]. " </td> <td style='text-align: center;'><a onclick='delSell(".$key.")'><i class='fa fa-minus-square' ></i></a></td> </tr>";
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