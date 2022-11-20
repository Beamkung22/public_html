<?php
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$color_status = new color_status;
if(isset($_POST['searchtime']) || isset($_POST['lesson'])){
?>
<html>
<body>
<table width="600" border="1">
<tr>
<?php 
if(isset($_POST['searchtime']) && $_POST['searchtime'] != ''){
?>
<th colspan="8" style="font-size: 150%;">สรุปผลตัวเลข วันที่ <?php echo $_POST['searchtime']; ?></th>
<?php
}else if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
?>
<th colspan="8" style="font-size: 150%;">สรุปผลตัวเลข งวด <?php echo $_POST['lesson']; ?></th>
<?php } ?>
</tr>
<tr>
<?php 
if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
?>
<th colspan="8" style="font-size: 125%;">สถานะ <?php echo $change_language->change_Status_listplay($_POST['stauts']); ?></th>
<?php
}else{
?>
<th colspan="8" style="font-size: 125%;">สถานะทั้งหมดของรางวัล</th>
<?php } ?>
</tr>
<tr>
                          <th>รูปแบบ/งวดที่</th>
                          <th>เลข</th>
                          <th>ประเภท</th>
                          <th>สถานะ</th>
                          <th>ยอดเดิมพัน</th>
                          <th>รวมส่วนลด</th>
                          <th>ยอดสุทธิ</th>
                          <th>รางวัลที่ได้</th>
                        </tr>
<?php 
                       $numPop = 0;
                       $sqld=" SELECT p.type 
                       , lct.lotto_val1 as price
                       , p.name as name_p
                       , p.row_id as row_id_product
                       , m.row_id as row_id_member
                       , t.row_id as rowIdTime
                       , t.name as name_t
                       , tu.status_cd
                       , tu.create_dt
                       FROM `lotto_item_user` tu 
                       , lotto_time t 
                       , member m 
                       , lotto_product p 
                       , lotto_config lc
                       , lotto_config lct
                       WHERE tu.time_id = t.row_id
                       and lct.lotto_name = p.type
                       and tu.member_id = m.row_id  
                       and tu.product_id = p.row_id
                       and lc.row_id = m.status
                       and lc.lotto_name in ('customer','admin')
                       and lc.active_flg = 'Y' ";
                       if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                        $nametime = $_POST['lesson'];
                        $sqld.="and t.name = '$nametime'";
                        $lesson = $_POST['lesson'];
                       }else{
                        $searchdate = $_POST['searchtime'];
                        $date = explode("-",$searchdate);
                        $searchtimefrom = date('Y-m-d H:i:s',strtotime($date[0]));
                        $searchtimeto = date('Y-m-d H:i:s',strtotime($date[1]));
                        $sqld.="and tu.create_dt BETWEEN '$searchtimefrom' AND '$searchtimeto' ";
                        $searchtime = $_POST['searchtime'];;
                       }
                       if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
                        $stauts = $_POST['stauts'];
                        $sqld.=" and tu.status_cd = '$stauts' ";
                       }else{
                        $sqld.=" and tu.status_cd <> 'Pending' ";
                       }
                       $sqld.=" group by name_p , type ";
                       $rsd=$cls_conn->select_base($sqld);
                       while($listplay=mysqli_fetch_array($rsd))
                       {
                      ?>
                        <tr>
                          <td><?php echo $listplay['name_t']; ?></td>
                          <td>=TEXT(<?php echo $listplay['name_p']; ?>,"<?php for($siz = 1; $siz <= strlen($listplay['name_p']); $siz++){ echo "0"; } ?>")</td>
                          <td><?php echo $change_language->change_type($listplay['type']); ?></td>
                          <td><text style="color:<?php echo $color_status->status_listplay($listplay['status_cd']); ?>;"><?php echo $change_language->change_Status_listplay($listplay['status_cd']); ?></text></td>
                          <?php 
                          $totalMoney = 0;
                          $totalPriceBuy = 0;
                          $totaldiscount = 0;
                          $totalPriceBuychk = 0;
                          $totalPriceBuyFull = 0;
                          $memberId = $listplay['row_id_member'];
                          $productId = $listplay['row_id_product'];
                          $sqldp=" SELECT tu.price as price_u 
                          , c.grossProfit
                          FROM `lotto_item_user` tu 
                          , lotto_time t 
                          , member m
                          , class c
                          WHERE tu.time_id = t.row_id
                          and m.class = c.row_id
                          and tu.product_id = '$productId' 
                          and m.row_id = '$memberId' ";
                          if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                            $nametime = $_POST['lesson'];
                            $sqldp.="and t.name = '$nametime'";
                          }else{
                            $searchdate = $_POST['searchtime'];
                            $date = explode("-",$searchdate);
                            $searchtimefrom = date('Y-m-d H:i:s',strtotime($date[0]));
                            $searchtimeto = date('Y-m-d H:i:s',strtotime($date[1]));
                            $sqldp.="and tu.create_dt BETWEEN '$searchtimefrom' AND '$searchtimeto' ";
                          }
                          if(isset($listplay['status_cd']) && $listplay['status_cd'] != ''){
                            $stauts = $listplay['status_cd'];
                            $sqldp.=" and tu.status_cd = '$stauts' ";
                          }else{
                            $sqldp.=" and tu.status_cd <> 'Pending' ";
                          }
                          $rsdp=$cls_conn->select_base($sqldp);
                          while($totalWin=mysqli_fetch_array($rsdp))
                          {
                            if($listplay['status_cd'] == "Win"){
                              $priceshow = $listplay['price'];
                              $rowIdP = $listplay['row_id_product'];
                              $rowIdT = $listplay['rowIdTime'];
                              $sqlhis =" SELECT *
                              FROM lotto_history_price hp
                              WHERE hp.product_id = '$rowIdP' 
                              AND hp.time_id = '$rowIdT' ";
                              $rsdhis=$cls_conn->select_base($sqlhis);
                              while($history=mysqli_fetch_array($rsdhis)){
                                $historyD = new DateTime($history["date_create"],new DateTimeZone('Asia/Bangkok'));
                                $historyDate = date("Y-m-d H:i:s",strtotime($historyD->format("Y-m-d H:i:s")));
                                $userBuy = new DateTime($listplay["create_dt"],new DateTimeZone('Asia/Bangkok'));
                                $userBuyDate = date("Y-m-d H:i:s",strtotime($userBuy->format("Y-m-d H:i:s")));
                                if($historyDate <= $userBuyDate){
                                  $priceshow = $history['price'];
                                  break;
                                }
                              }

                              $totalWinprice = $priceshow*$totalWin['price_u'];
                              $totalMoney = $totalMoney+$totalWinprice;
                            } 
                            $totalPriceBuychk = $totalWin['price_u'];
                            $totalPriceBuyFull = $totalPriceBuyFull+$totalWin['price_u'];

                            $persen = 0;
                            $totalmoneydis = 0;
                            $discount = 0;
                            if($totalWin['grossProfit'] != '' && $totalWin['grossProfit'] > 0){
                              $persen = $totalWin['grossProfit'];
                              $discount = ($totalPriceBuychk*$persen)/100;
                              $totalmoneydis = $totalPriceBuychk - $discount;
                            }else{
                              $totalmoneydis = $totalPriceBuychk;
                            }
                            $totalPriceBuy = $totalPriceBuy+$totalmoneydis;
                            $totaldiscount = $totaldiscount + $discount;
                          }
                          ?>
                          <td><?php echo number_format($totalPriceBuyFull)." ฿"; ?></td>
                          <td><?php echo number_format($totaldiscount)." ฿"; ?></td>
                          <td><?php echo number_format($totalPriceBuy)." ฿"; ?></td>
                          <td><?php echo number_format($totalMoney)." ฿"; ?></td>
                        </tr>
                        <?php 
                       }
                        ?>

</table>
</body>
</html>
<?php 
}
?>