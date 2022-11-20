    <!-- validator --> 
<div id="myNav" class="overlay">
<div class="loader"></div>
</div>
          <div class="x_panel">
                  <div class="x_title">
                    <h2>รางวัล </h2>
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
                  <form method="post">

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="awardtime" class="form-control">
                              <option value="">กรุณาเลือกงวด..</option>
                              <?php 
                              $sqlTimeClose=" select t.* from lotto_time t where t.status = 'Close' ";
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

                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <button type="submit" class="btn btn-round btn-info">ค้นหา</button>
                    </div>
                  </form>
                  <hr>
                  <?php 
                  if(isset($_POST['awardtime']) && $_POST['awardtime'] != ''){
                    $timeId = $_POST['awardtime'];

                    $sqlTime=" select t.* from lotto_time t where t.row_id = '$timeId' ";
                    $rsdTime=$cls_conn->select_base($sqlTime);
                    $time=mysqli_fetch_array($rsdTime);

                    $nametime = $time['name'];
                  ?>
                    <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

                        <div class="item form-group pull-right">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" style="width:10%;">งวด
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input readonly style="width:300px;" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" value="<?php echo $nametime; ?>" type="text">
                        </div>
                        </div>
                        <br>
                        <br>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">รางวัลที่ 1
                        </label>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='C' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $C = '';
                        while($dataC=mysqli_fetch_array($rsdData)){
                          $C = $dataC['number'];
                        }
                        ?>
                            <input maxlength="6" value="<?php if($C != ""){echo $C;}else{echo "";}?>" type="text" id="champions" name="champions" onchange="onchangeChampions(this)" placeholder="รางวัลที่ 1" class="form-control">
                        </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">3 ตัวบน
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='H3' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $H3_1 = '';
                        while($dataH=mysqli_fetch_array($rsdData)){
                          $H3_1 = $dataH['number'];
                        }
                        ?>
                          <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($H3_1 != ""){echo $H3_1;}else{echo "";}?>" type="text" id="H3_1" name="H3_1" placeholder="3 บน" class="form-control">
                          </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">3 ตัวล่าง
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='L3' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $numberchk = 0;
                        $L3_1 = '';
                        $L3_2 = '';
                        $L3_3 = '';
                        $L3_4 = '';
                        while($dataL=mysqli_fetch_array($rsdData)){
                          $numberchk++;
                            if($numberchk == 1){
                              $L3_1 = $dataL['number'];
                            }else if($numberchk == 2){
                              $L3_2 = $dataL['number'];
                            }else if($numberchk == 3){
                              $L3_3 = $dataL['number'];
                            }else{
                              $L3_4 = $dataL['number'];
                            }
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($L3_1 != ""){echo $L3_1;}else{echo "";}?>" type="text" id="L3_1" name="L3_1" placeholder="3 ตัวล่าง" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($L3_2 != ""){echo $L3_2;}else{echo "";}?>" type="text" id="L3_2" name="L3_2" placeholder="3 ตัวล่าง" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($L3_3 != ""){echo $L3_3;}else{echo "";}?>" type="text" id="L3_3" name="L3_3" placeholder="3 ตัวล่าง" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($L3_4 != ""){echo $L3_4;}else{echo "";}?>" type="text" id="L3_4" name="L3_4" placeholder="3 ตัวล่าง" class="form-control">
                        </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">3 ตัวโต๊ด
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='T3' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $numberchk = 0;
                        $T3_1 = '';
                        $T3_2 = '';
                        $T3_3 = '';
                        $T3_4 = '';
                        $T3_5 = '';
                        $T3_6 = '';
                        while($dataT=mysqli_fetch_array($rsdData)){
                          $numberchk++;
                            if($numberchk == 1){
                              $T3_1 = $dataT['number'];
                            }else if($numberchk == 2){
                              $T3_2 = $dataT['number'];
                            }else if($numberchk == 3){
                              $T3_3 = $dataT['number'];
                            }else if($numberchk == 4){
                              $T3_4 = $dataT['number'];
                            }else if($numberchk == 5){
                              $T3_5 = $dataT['number'];
                            }else{
                              $T3_6 = $dataT['number'];
                            }
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_1 != ""){echo $T3_1;}else{echo "";}?>" type="text" id="T3_1" name="T3_1" onchange="onchangeT(this,'')" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_2 != ""){echo $T3_2;}else{echo "";}?>" type="text" id="T3_2" name="T3_2" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_3 != ""){echo $T3_3;}else{echo "";}?>" type="text" id="T3_3" name="T3_3" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_4 != ""){echo $T3_4;}else{echo "";}?>" type="text" id="T3_4" name="T3_4" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_5 != ""){echo $T3_5;}else{echo "";}?>" type="text" id="T3_5" name="T3_5" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="3" value="<?php if($T3_6 != ""){echo $T3_6;}else{echo "";}?>" type="text" id="T3_6" name="T3_6" placeholder="3 ตัวโต๊ด" class="form-control">
                        </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">2 ตัวบน
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='H2' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $H2_1 = '';
                        while($dataH=mysqli_fetch_array($rsdData)){
                          $H2_1 = $dataH['number'];
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="2" value="<?php if($H2_1 != ""){echo $H2_1;}else{echo "";}?>" type="text" id="H2_1" name="H2_1" placeholder="2 ตัวบน" class="form-control">
                        </div>

                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">2 ตัวล่าง
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='L2' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $L2_1 = '';
                        while($dataL=mysqli_fetch_array($rsdData)){
                          $L2_1 = $dataL['number'];
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="2" value="<?php if($L2_1 != ""){echo $L2_1;}else{echo "";}?>" type="text" id="L2_1" name="L2_1" onchange="onchangeOneLow(this)" placeholder="2 ตัวล่าง" class="form-control">
                        </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">1 ตัวบน
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='H1' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $numberchk = 0;
                        $H1_1 = '';
                        $H1_2 = '';
                        $H1_3 = '';
                        while($dataT=mysqli_fetch_array($rsdData)){
                          $numberchk++;
                            if($numberchk == 1){
                              $H1_1 = $dataT['number'];
                            }else if($numberchk == 2){
                              $H1_2 = $dataT['number'];
                            }else{
                              $H1_3 = $dataT['number'];
                            }
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="1" value="<?php if($H1_1 != ""){echo $H1_1;}else{echo "";}?>" type="text" id="H1_1" name="H1_1" placeholder="1 ตัวบน" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="1" value="<?php if($H1_2 != ""){echo $H1_2;}else{echo "";}?>" type="text" id="H1_2" name="H1_2" placeholder="1 ตัวบน" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="1" value="<?php if($H1_3 != ""){echo $L3_1;}else{echo "";}?>" type="text" id="H1_3" name="H1_3" placeholder="1 ตัวบน" class="form-control">
                        </div>
                        </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">1 ตัวล่าง
                        </label>
                        <?php 
                        $sqlGetData=" select la.* from lotto_award la where la.type='L1' and la.time_id = '$timeId' ";
                        $rsdData=$cls_conn->select_base($sqlGetData);
                        $numberchk = 0;
                        $L1_1 = '';
                        $L1_2 = '';
                        while($dataT=mysqli_fetch_array($rsdData)){
                          $numberchk++;
                            if($numberchk == 1){
                              $L1_1 = $dataT['number'];
                            }else{
                              $L1_2 = $dataT['number'];
                            }
                        }
                        ?>
                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="1" value="<?php if($L1_1 != ""){echo $L1_1;}else{echo "";}?>" type="text" id="L1_1" name="L1_1" placeholder="1 ตัวล่าง" class="form-control">
                        </div>

                        <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                            <input maxlength="1" value="<?php if($L1_2 != ""){echo $L1_2;}else{echo "";}?>" type="text" id="L1_2" name="L1_2" placeholder="1 ตัวล่าง" class="form-control">
                        </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-primary">Cancel</button>
                            <button id="send" onclick="insertChampions('<?php echo $timeId; ?>')" type="button" class="btn btn-success">Submit</button>
                        </div>
                        </div>
                        </form>
                <?php 
                  }
                ?>
                  </div>
                </div>
                <script src="../js/change_number_all.js"></script>
                <script src="../js/submit_award.js"></script>

                  
                        