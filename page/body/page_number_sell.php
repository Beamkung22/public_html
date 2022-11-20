<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>จำนวนขาย </h2>
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
                              $sqlTimeClose=" select t.* from lotto_time t where t.status in ('Pending','Open') ";
                              $rsdTimeClose=$cls_conn->select_base($sqlTimeClose);
                              while($timeClose=mysqli_fetch_array($rsdTimeClose))
                                { 
                              ?>
                              <option value="<?php echo $timeClose['row_id']; ?>"><?php echo $timeClose['name']; ?></option>
                              <?php 
                                }
                              ?>
                            </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:5%;">
                      <button type="submit" class="btn btn-round btn-info">ค้นหา</button>
                    </div>
                  </form>
                  <hr>
                  <div id="showDatalist">
                  </div>
                  <?php 
                  $numPop = 0;
                  if(isset($_POST['lesson']) && $_POST['lesson'] != ''){
                    $rowIdTime = $_POST['lesson'];
                  ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>เลข</th>
                          <th>ประเภท</th>
                          <th>งวด</th>
                          <th>จำนวนเงินขาย</th>
                          <th>ตรวจสอบ</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                       $sqld=" select lp.*
                       , t.name as name_t
                       from 
                       lotto_product lp 
                       , lotto_time t
                       where 
                       t.row_id = '$rowIdTime'
                       and lp.time_id = t.row_id ";
                       $rsd=$cls_conn->select_base($sqld);
                       while($productName=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $productName['name']; ?></td>
                          <td><?php echo $change_language->change_type($productName['type']); ?></td>
                          <td><?php echo $productName['name_t']; ?></td>
                          <td><?php 
                          if($productName['flag_fix'] == 'Y'){
                            echo number_format($productName['price_fix'])." ฿";
                          }else{
                            echo "∞";
                          } ?></td>
                          <td> <a onclick="editSetting('<?php echo $productName['row_id']; ?>')" ><i class="fa fa-edit"></i></a></td>
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
<?php include('popup/popup_sellnumber.php'); ?>
<script src="../js/manage_sellnumber.js">
</script>