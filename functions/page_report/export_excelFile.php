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
<th colspan="14" style="font-size: 150%;">สรุปผล วันที่ <?php echo $_POST['searchtime']; ?></th>
<?php
}else if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
?>
<th colspan="14" style="font-size: 150%;">สรุปผล งวด <?php echo $_POST['lesson']; ?></th>
<?php } ?>
</tr>
<tr>
<?php 
if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
?>
<th colspan="14" style="font-size: 125%;">สถานะ <?php echo $change_language->change_Status_listplay($_POST['stauts']); ?></th>
<?php
}else{
?>
<th colspan="14" style="font-size: 125%;">สถานะทั้งหมดของรางวัล</th>
<?php } ?>
</tr>
<tr>
<th rowspan="2">รหัสเลขเดิมพัน. </th>
                          <th rowspan="2">เวลาที่ลงเดิมพัน</th>
                          <th rowspan="2">รูปแบบ/งวดที่</th>
                          <th colspan="2">วิธีเล่น/เลขเดิมพัน</th>
                          <th rowspan="2">ลูกค้า</th>
                          <th rowspan="2">ราคาจ่าย</th>
                          <th rowspan="2">สถานะ</th>
                          <th rowspan="2">ยอดเดิมพัน</th>
                          <th rowspan="2">ส่วนลด</th>
                          <th rowspan="2">รวมส่วนลด</th>
                          <th rowspan="2">ยอดสุทธิ</th>
                          <th rowspan="2">ถูกรางวัล</th>
                          <th rowspan="2">รางวัลที่ได้</th>
</tr>
<tr>
<th>ประเภท </th>
                          <th>เลข</th>
</tr>
<?php 
                       $numPop = 0;
                       $sqld=" SELECT tu.numberNo 
                       , tu.create_dt 
                       , t.name as name_t
                       , p.name as name_p
                       , p.type 
                       , tu.price as price_u 
                       , tu.status_cd
                       , m.name
                       , c.grossProfit
                       , lc1.lotto_val1 as price
                       , p.row_id as rowIdProduct
                       , t.row_id as rowIdTime
                       FROM `lotto_item_user` tu 
                       , lotto_time t 
                       , member m 
                       , lotto_product p 
                       , lotto_config lc
                       , lotto_config lc1
                       , class c
                       WHERE tu.time_id = t.row_id
                       and tu.member_id = m.row_id  
                       and tu.product_id = p.row_id
                       and lc.row_id = m.status
                       and lc1.lotto_name = p.type
                       and lc.lotto_name in ('customer','admin')
                       and m.class = c.row_id
                       and lc.active_flg = 'Y' ";
                       if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                        $nametime = $_POST['lesson'];
                        $sqld.="and t.name = '$nametime'";
                       }else{
                        $searchdate = $_POST['searchtime'];
                        $date = explode("-",$searchdate);
                        $searchtimefrom = date('Y-m-d H:i:s',strtotime($date[0]));
                        $searchtimeto = date('Y-m-d H:i:s',strtotime($date[1]));
                        $sqld.="and tu.create_dt BETWEEN '$searchtimefrom' AND '$searchtimeto' ";
                       }
                       if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
                        $stauts = $_POST['stauts'];
                        $sqld.=" and tu.status_cd = '$stauts' ";
                       }else{
                        $sqld.=" and tu.status_cd <> 'Pending' ";
                      }
                       $rsd=$cls_conn->select_base($sqld);
                       while($listplay=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $listplay['numberNo']; ?></td>
                          <td><?php echo $listplay['create_dt']; ?></td>
                          <td><?php echo $listplay['name_t']; ?></td>
                          <td><?php echo $change_language->change_type($listplay['type']); ?></td>
                          <td>=TEXT(<?php echo $listplay['name_p']; ?>,"<?php for($siz = 1; $siz <= strlen($listplay['name_p']); $siz++){ echo "0"; } ?>")</td>
                          <td><?php echo $listplay['name']; ?></td>
                          <td><?php echo number_format($listplay['price'])." ฿"; ?></td>
                          <td><text style="color:<?php echo $color_status->status_listplay($listplay['status_cd']); ?>;"><?php echo $change_language->change_Status_listplay($listplay['status_cd']); ?></text></td>
                          <td><?php echo number_format($listplay['price_u'])." ฿"; ?></td>
                          <?php 
                          $persen = 0;
                          $totalmoneydis = 0;
                          $discount = 0;
                            if($listplay['grossProfit'] != '' && $listplay['grossProfit'] > 0){
                                $persen = $listplay['grossProfit'];
                                $discount = ($listplay['price_u']*$persen)/100;
                                $totalmoneydis = $listplay['price_u'] - $discount;
                            }else{
                                $totalmoneydis = $listplay['price_u'];
                            }
                          ?>
                          <td><?php echo number_format($persen)." %"; ?></td>
                          <td><?php echo number_format($discount)." ฿"; ?></td>
                          <td><?php echo number_format($totalmoneydis)." ฿"; ?></td>
                          <?php
                          $totalWin = 0;
                          $priceWin = 0;
                          if($listplay['status_cd'] == "Win"){
                            $priceshow = $listplay['price'];
                              $rowIdP = $listplay['rowIdProduct'];
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
                            $totalWin = $priceshow*$listplay['price_u'];
                          }
                          ?>
                          <td><?php echo number_format($priceWin)." ฿"; ?></td>
                          <td><?php echo number_format($totalWin)." ฿"; ?></td>
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