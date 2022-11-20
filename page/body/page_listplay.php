<?php 
if(isset($_POST['lesson'])){
$_SESSION['report']['lesson'] = $_POST['lesson'];
}
?>
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายการเดิมพัน </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post">
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="lesson" class="form-control">
                              <option value="">กรุณาเลือกงวด..</option>
                              <?php 
                              $sqlTimeClose=" select t.* from lotto_time t where t.status in ('Close','Open') ";
                              $rsdTimeClose=$cls_conn->select_base($sqlTimeClose);
                              while($timeClose=mysqli_fetch_array($rsdTimeClose))
                                { 
                              ?>
                              <option <?php if(isset($_SESSION['report']['lesson']) && $_SESSION['report']['lesson'] == $timeClose['name']){ echo "selected";} ?> value="<?php echo $timeClose['name']; ?>"><?php echo $timeClose['name']; ?></option>
                              <?php 
                                }
                              ?>
                            </select>
                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="typenumber" class="form-control">
                              <option value="">วิธีเล่นทั้งหมด</option>
                              <option value="H2">บน2</option>
                              <option value="L2">ล่าง2</option>
                              <option value="H3">บน3</option>
                              <option value="L3">ล่าง3</option>
                              <option value="T3">โต๊ด</option>
                              <option value="R">วิ่ง</option>
                            </select>
                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:13%;">
                      <select name="stauts" class="form-control">
                              <option value="">สถานะทั้งหมด</option>
                              <option value="Pending">ยังไม่ได้เปิดรางวัล</option>
                              <option value="Cancel">ยกเลิกการเดิมพัน</option>
                              <option value="Lost">ไม่ถูกรางวัล</option>
                              <option value="Win">ถูกรางวัล</option>
                            </select>
                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:5%;">
                      <button type="submit" class="btn btn-round btn-info">ค้นหา</button>
                    </div>
                  </form>
                  <hr>
                  <?php 
                  if(isset($_POST['lesson'])){
                  ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>รหัสเลขเดิมพัน. </th>
                          <th>เวลาที่ลงเดิมพัน</th>
                          <th>รูปแบบ/งวดที่</th>
                          <th>วิธีเล่น/เลขเดิมพัน</th>
                          <th>ราคาจ่าย</th>
                          <th>สถานะ</th>
                          <th>ยอดเดิมพัน</th>              
                          <th>ส่วนลด</th>        
                          <th>รวมส่วนลด</th>
                          <th>ยอดสุทธิ</th>
                          <th>ถูกรางวัล</th>
                          <th>รางวัลที่ได้</th>
                          <th>ยกเลิก</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php 
                       $numPop = 0;
                       $sqld=" SELECT tu.numberNo 
                       , tu.create_dt 
                       , t.name as name_t
                       , p.name as name_p
                       , p.type 
                       , lc.lotto_val1 as price
                       , tu.price as price_u 
                       , tu.status_cd
                       , p.row_id as rowIdProduct
                       , t.row_id as rowIdTime
                       FROM `lotto_item_user` tu 
                       , lotto_time t 
                       , lotto_product p 
                       , lotto_config lc
                       WHERE tu.member_id = '$memberlogin'
                       and lc.lotto_name = p.type
                       and tu.time_id = t.row_id 
                       and tu.product_id = p.row_id ";
                       if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                        $nametime = $_POST['lesson'];
                        $sqld.="and t.name = '$nametime'";
                       }
                       if(isset($_POST['typenumber']) && $_POST['typenumber'] != ''){
                        $type = $_POST['typenumber'];
                        $sqld.=" and p.type = '$type' ";
                       }
                       if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
                        $stauts = $_POST['stauts'];
                        $sqld.=" and tu.status_cd = '$stauts' ";
                       }
                       $sqld.=" order by tu.create_dt desc ";
                       $rsd=$cls_conn->select_base($sqld);
                       while($listplay=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $listplay['numberNo']; ?></td>
                          <td><?php echo $listplay['create_dt']; ?></td>
                          <td><?php echo $listplay['name_t']; ?></td>
                          <td><?php echo $change_language->change_type($listplay['type'])." / ".$listplay['name_p']; ?></td>
                          <?php 
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
                          ?>
                          <td><?php echo number_format($priceshow)." ฿"; ?></td>
                          <td><text style="color:<?php echo $color_status->status_listplay($listplay['status_cd']); ?>;"><?php echo $change_language->change_Status_listplay($listplay['status_cd']); ?></text></td>
                          <td><?php echo number_format($listplay['price_u'])." ฿"; ?></td>
                          <?php 
                          $persen = 0;
                          $totalmoneydis = 0;
                          $discount = 0;
                          if(isset($_SESSION['id_member'])){
                            $rowIdMember = $_SESSION['id_member'];
                            $query = "SELECT c.grossProfit FROM member m , class c WHERE m.row_id = '$rowIdMember' and m.class = c.row_id";
                            $list = $cls_conn->select_base($query);
                            $row = mysqli_fetch_array($list);
                            if($row['grossProfit'] != '' && $row['grossProfit'] > 0){
                                $persen = $row['grossProfit'];
                                $discount = ($listplay['price_u']*$persen)/100;
                                $totalmoneydis = $listplay['price_u'] - $discount;
                            }else{
                                $totalmoneydis = $listplay['price_u'];
                            }
                          }
                          ?>
                          <td><?php echo number_format($persen)." %"; ?></td>
                          <td><?php echo number_format($discount)." ฿"; ?></td>
                          <td><?php echo number_format($totalmoneydis)." ฿"; ?></td>
                          <?php
                          $totalWin = 0;
                          $priceWin = 0;
                          if($listplay['status_cd'] == "Win"){
                            $priceWin = $listplay['price'];
                            $totalWin = $listplay['price']*$listplay['price_u'];
                          }
                          ?>
                          <td><?php echo number_format($priceWin)." ฿"; ?></td>
                          <td><?php echo number_format($totalWin)." ฿"; ?></td>
                          <?php 
                          $cdate = $listplay['create_dt'];
                          $cnewDate = date("Y-m-d H:i:s",strtotime($cdate." +".$timeConfig." minutes"));
                        if($listplay['status_cd'] != "Cancel" && $cnewDate >= $StrdateCurChk && $rowIdTime != ""){
                            ?>
                          <td><button type="button" class="btn btn-round btn-info" onclick="deletelisyplay('<?php echo $listplay['numberNo']; ?>')">ยกเลิก</button></td>
                          <?php
                        }else{
                          ?><td></td><?php
                        }
                        ?>
                        </tr>
                        <?php 
                       }
                        ?>
                      </tbody>
                    </table>
                    <?php 
                  }
                    ?>
                  </div>
                </div>
              </div>
</div>

<script src="../js/list_play.js"></script>