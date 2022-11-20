<?php 

if(isset($_POST['lesson'])){

$_SESSION['report']['lesson'] = $_POST['lesson'];

}

?>

<div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>รายการสรุปผลตัวเลข </h2>

                    <ul class="nav navbar-right panel_toolbox">

                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                      </li>

                    </ul>

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                  <form method="post">

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">

                      <select id="lesson" name="lesson" class="form-control">

                              <option value="">กรุณาเลือกงวด..</option>

                              <?php 

                              $sqlTimeClose=" select t.* from lotto_time t ";

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



                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:13%;">

                      <select id="stauts" name="stauts" class="form-control">

                              <option value="">กรุณาเลือกสถานะ..</option>

                              <option value="Cancel">ยกเลิกการเดิมพัน</option>

                              <option value="Lost">ไม่ถูกรางวัล</option>

                              <option value="Win">ถูกรางวัล</option>

                            </select>

                    </div>



                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:5%;">

                      <button type="submit" class="btn btn-round btn-info">ค้นหา</button>

                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:5%;">

                      <a class="btn label-success" onclick="exportexcel()"style="margin-right: 5px; color:white;"><i class="fa fa-download"></i> Generate Excel</a>

                    </div>

                  </form>

                  <hr>

                  <?php 

                  if(isset($_POST['lesson']) && ($_POST['lesson'] != "" || $_POST['stauts'] != "")){

                    $lesson = "";

                    $searchtime = "";

                    $totalbuy = 0;

                    $totalaward = 0;

                    $totalprofit = 0;

                  ?>

                    <table id="datatable" class="table table-striped table-bordered">

                      <thead>

                        <tr>

                          <th>รูปแบบ/งวดที่</th>

                          <th>เลข</th>

                          <th>ประเภท</th>

                          <th>สถานะ</th>

                          <th>ยอดเดิมพัน</th>

                          <th>รวมส่วนลด</th>

                          <th>ยอดสุทธิ</th>

                          <th>รางวัลที่ได้</th>

                          <th>ตรวจสอบข้อมูลรางวัล</th>

                        </tr>

                      </thead>





                      <tbody>

                      <?php 

                       $numPop = 0;

                       $totaldiscountAll = 0;

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

                       }

                       if(isset($_POST['stauts']) && $_POST['stauts'] != ''){

                        $stauts = $_POST['stauts'];

                        $sqld.=" and tu.status_cd = '$stauts' ";

                       }
                       $sqld.=" group by name_p , type ";

                       $rsd=$cls_conn->select_base($sqld);

                       while($listplay=mysqli_fetch_array($rsd))

                       {

                      ?>

                        <tr>

                          <td><?php echo $listplay['name_t']; ?></td>

                          <td><?php echo $listplay['name_p']; ?></td>

                          <td><?php echo $change_language->change_type($listplay['type']); ?></td>

                          <td><text style="color:<?php echo $color_status->status_listplay($listplay['status_cd']); ?>;"><?php echo $change_language->change_Status_listplay($listplay['status_cd']); ?></text></td>

                          <?php 

                          $totalMoney = 0;

                          $totalPriceBuy = 0;

                          $totaldiscount = 0;

                          $totalPriceBuychk = 0;

                          $totalPriceBuyFull = 0;

                          $productId = $listplay['row_id_product'];

                          $sqldp=" SELECT tu.price as price_u 

                          , c.grossProfit

                          FROM `lotto_item_user` tu 

                          , lotto_time t 

                          , member m

                          , class c

                          WHERE tu.time_id = t.row_id

                          and tu.product_id = '$productId'

                          and tu.member_id = m.row_id

                          and m.class = c.row_id ";

                          if(isset($_POST['lesson']) && $_POST['lesson'] != ''){

                            $nametime = $_POST['lesson'];

                            $sqldp.="and t.name = '$nametime'";

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



                          if($listplay['status_cd'] != "Cancel"){

                            $totalbuy = $totalbuy + $totalPriceBuy;

                            $totaldiscountAll = $totaldiscountAll + $totaldiscount;

                          }

                          if($listplay['status_cd'] == "Win"){

                            $totalaward = $totalaward+$totalMoney;

                          }

                          ?>

                          <td><?php echo number_format($totalPriceBuyFull)." ฿"; ?></td>

                          <td><?php echo number_format($totaldiscount)." ฿"; ?></td>

                          <td><?php echo number_format($totalPriceBuy)." ฿"; ?></td>

                          <td><?php echo number_format($totalMoney)." ฿"; ?></td>

                          <td><a onclick="showdata('<?php echo  $lesson;?>','<?php echo $searchtime;?>','<?php echo $listplay['row_id_member']; ?>','<?php echo $listplay['row_id_product']; ?>','<?php echo $listplay['status_cd']; ?>')" ><i class="fa fa-edit"></i></a></td>

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

                          <th>รวมส่วนลด</th>

                          <th>ยอดสุทธิ</th>

                          <th>รวมยอดเงินรางวัล</th>

                          <th>กำไร</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td><?php echo number_format($totaldiscountAll)." ฿"; ?></td>

                          <td><?php echo number_format($totalbuy)." ฿"; ?></td>

                          <td><?php echo number_format($totalaward)." ฿"; ?></td>

                          <?php $totalprofit = $totalbuy-$totalaward; ?>

                          <td><?php echo number_format($totalprofit)." ฿"; ?></td>

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

<div id="myModal" class="modal fade" tabindex="-1">

        <div class="modal-dialog" style="width:50%;">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">รายการเดิมพัน</h5>

                    <text>คุณ </text><text id="name"/>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <br>

                <div class="modal-body">

                  <div id="tableShow">

                  </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ออกจากเมนู</button>

                </div>

            </div>

        </div>

    </div>



<script>

function showdata(lesson,searchtime,memberId,proId,stauts){

    checkmember(memberId);

    $.ajax({

        url:"../functions/page_report/page_report_product_show.php",

        method:"POST",

        data:"lesson="+lesson+

        "&searchtime="+searchtime+

        "&proId="+proId+

        "&stauts="+stauts,

        success:function(data)

        {

          $("#tableShow").html(data);

          $("#myModal").modal('show');

        }

        })

}

function checkmember(rowId){

  $.ajax({

        url:"../functions/showMember/manage_member.php",

        method:"POST",

        data:"idMember="+rowId,

        success:function(data)

        {

          var res = data.split("|");

          rowIdMemberUpdate = res[0];

          nameMember = res[1];

          $('#name').html(nameMember);

        }

        })

}

function exportexcel(){

  var timesearch = '';

  var lesson = '';

  var status = '';

    if(document.getElementById("lesson").value == ''){

      timesearch = document.getElementById("reservation-time").value;

    }else{

      lesson = document.getElementById("lesson").value;

    }

    if(document.getElementById("stauts").value != ''){

      status = document.getElementById("stauts").value;

    }

    var url = 'data:application/vnd.ms-excel,';

    $.ajax({

        url:"../functions/page_report/export_excelFile_product.php",

        method:"POST",

        data:"lesson="+lesson+

        "&searchtime="+timesearch+

        "&stauts="+status,

        success:function(data)

        {

          var timeproject = '';

          if(lesson != ""){

            timeproject = lesson;

          }else if(timesearch != ""){

            timeproject = timesearch;

          }

          if(status == ''){

            status = "All";

          }

          var link = document.createElement("a");

            link.download = "lotto_report_"+timeproject+"_"+status+".xls";

            link.href = url + encodeURIComponent(data);

            link.click();

        }

        })

}

</script>