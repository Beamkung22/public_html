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

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:15%;">
                      <select name="typenumber" class="form-control">
                              <option value="">วิธีเล่นทั้งหมด</option>
                              <option value="H2">2บน</option>
                              <option value="L2">2ล่าง</option>
                              <option value="H3">3บน</option>
                              <option value="L3">3ล่าง</option>
                              <option value="T3">โต๊ด</option>
                              <option value="R">วิ่ง</option>
                            </select>
                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="customer" class="form-control">
                              <option value="">ลูกค้าทั้งหมด</option>
                              <?php 
                              $sqlm=" SELECT m.name , m.row_id FROM `member` m , lotto_config lc WHERE m.status = lc.row_id and lc.lotto_name = 'customer' ";
                              $rsm=$cls_conn->select_base($sqlm);
                              while($customer=mysqli_fetch_array($rsm))
                              {
                              ?>
                              <option value="<?php echo $customer['row_id']; ?>"><?php echo $customer['name']; ?></option>
                              <?php } ?>
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
                          <th>วิธีเล่น</th>
                          <th>เลขเดิมพัน</th>
                          <th>ลูกค้า</th>
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
                       , p.price 
                       , tu.price as price_u 
                       , tu.status_cd
                       , m.name
                       , c.grossProfit
                       FROM `lotto_item_user` tu 
                       , lotto_time t 
                       , member m 
                       , lotto_product p 
                       , lotto_config lc
                       , class c
                       WHERE tu.time_id = t.row_id
                       and tu.member_id = m.row_id  
                       and tu.product_id = p.row_id
                       and lc.row_id = m.status
                       and lc.lotto_name in ('customer','admin')
                       and lc.active_flg = 'Y' 
                       and m.class = c.row_id ";
                       if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                        $nametime = $_POST['lesson'];
                        $sqld.="and t.name = '$nametime'";
                       }
                       if(isset($_POST['typenumber']) && $_POST['typenumber'] != ''){
                        $type = $_POST['typenumber'];
                        $sqld.=" and p.type = '$type' ";
                       }
                       if(isset($_POST['customer']) && $_POST['customer'] != ''){
                        $customer = $_POST['customer'];
                        $sqld.=" and m.row_id = '$customer' ";
                       }
                       if(isset($_POST['stauts']) && $_POST['stauts'] != ''){
                        $stauts = $_POST['stauts'];
                        $sqld.=" and tu.status_cd = '$stauts' ";
                       }
                       $rsd=$cls_conn->select_base($sqld);
                       $totalbuy = 0;
                       $totaldiscount = 0;
                       $totalplay = 0;
                       while($listplay=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $listplay['numberNo']; ?></td>
                          <td><?php echo $listplay['create_dt']; ?></td>
                          <td><?php echo $listplay['name_t']; ?></td>
                          <td><?php echo $change_language->change_type($listplay['type']); ?></td>
                          <td><?php echo $listplay['name_p']; ?></td>
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
                            $priceWin = $listplay['price'];
                            $totalWin = $listplay['price']*$listplay['price_u'];
                          }

                          if($listplay['status_cd'] != "Cancel"){
                            $totalbuy = $totalbuy + $totalmoneydis;
                            $totaldiscount = $totaldiscount + $discount;
                            $totalplay = $totalplay + $listplay['price_u'];
                          }
                          ?>
                          <td><?php echo number_format($priceWin)." ฿"; ?></td>
                          <td><?php echo number_format($totalWin)." ฿"; ?></td>
                          <?php 
                        if($listplay['status_cd'] != "Cancel" && $listplay['status_cd'] != "Win"  && $listplay['status_cd'] != "Lost"){
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
                    <div class="x_content pull-right" style="width:500px;">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>รวมเดิมพัน</th>
                          <th>รวมส่วนลด</th>
                          <th>ยอดสุทธิ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo number_format($totalplay)." ฿"; ?></td>
                          <td><?php echo number_format($totaldiscount)." ฿"; ?></td>
                          <td><?php echo number_format($totalbuy)." ฿"; ?></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                    <?php 
                  }
                    ?>
                  </div>
                </div>
              </div>
</div>

<script src="../js/list_play.js"></script>