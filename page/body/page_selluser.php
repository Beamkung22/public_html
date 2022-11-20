 <!-- top tiles -->
 <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2 style="font-size:30px;">งวดที่ : <?php echo $nameTime." เวลา ".$startTime." ถึง ".$endTime; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                <div class="x_content">


                <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>เลือกจากแผง</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="margin: auto;">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default active" onclick="onchecklenNumber(2)">
                          <input type="radio" name="options" id="two" value="2" checked>⚁ สองตัว
                        </label>
                        <label class="btn btn-default" onclick="onchecklenNumber(3)">
                          <input type="radio" name="options" id="three" value="3">⚂ สามตัว
                        </label>
                        <label class="btn btn-default" onclick="onchecklenNumber(1)">
                          <input type="radio" name="options" id="one" value="1" >⚀ เลขวิ่ง
                        </label>
                      </div>
                    <hr>
                          <div id="numbertype" class="btn-group" data-toggle="buttons" style="width:100%;">
                            <label class="btn btn-danger active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(2,'H',1)">
                              <input type="radio" name="gender" value="male" checked> บน
                            </label>
                            <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(2,'L',1)">
                              <input type="radio" name="gender" value="female"> ล่าง
                            </label>
                          </div>

                    <hr>
                    <div id="changenumber" class="btn-group" style="width:100%;">

                    </div>
                    

                        <hr>
                  <?php 
                  $numrow = 0;
                  $pagenum = 0;
                  $pageKeyName = "";

                  //Query Product ALL
                  $sqlItem_pro=" select p.name , p.row_id , p.flag_fix , p.price_fix from lotto_product p where p.type = 'H2' ";
                  $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                  $sqlItem_pro.=" order by p.name asc ";
                  $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                  while($item_pro=mysqli_fetch_array($rsdItem_pro)){
                      $numrow++;
                      if($numrow == 1){
                        $pageKeyName = $item_pro['name'];
                        //$pageName[$pagenum] = $item_pro['name']
                      }
                      $pageDataShow[$pageKeyName][$numrow] = $item_pro['name'];
                      $pageflagfix[$pageKeyName][$numrow] = $item_pro['flag_fix'];
                      $pagenumberfix[$pageKeyName][$numrow] = $item_pro['price_fix'];
                      if($numrow == 100){
                        $numrow = 0;
                        $pageKeyName = "";
                      }
                  }
                  ?>
                  <div id="datanumber" style="width:90%;" class="center" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php 
                        $num = 0;
                        foreach($pageDataShow as $key => $one) {
                        $num++; ?>
                        <li role="presentation" <?php if($num == 1){ echo "class='active'"; }else{ echo "class=''";} ?>><a href="#tab_content<?php echo $num; ?>" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo $key; ?></a>
                        </li>
                        <?php } ?>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <?php 
                        $numValue = 0;
                          foreach($pageDataShow as $key => $one) {
                            $numValue++;
                            $pagename = $key;
                            ?>
                            <div role="tabpanel" <?php if($numValue == 1){ echo "class='tab-pane fade active in'"; }else{ echo "class='tab-pane fade'";} ?> id="tab_content<?php echo $numValue; ?>" aria-labelledby="home-tab">
                            <?php
                            foreach($pageDataShow[$key] as $keys => $value) {
                              if ($pageflagfix[$pagename][$keys] == "N" 
                                  ||  ($pageflagfix[$pagename][$keys] == "Y" && $pagenumberfix[$pagename][$keys] > 0)){
                              ?>
                              <input type="checkbox" name="A" class="a" value="<?php echo $value; ?>" onclick="oncheckNumber(this,'H2','1')" <?php if(isset($_SESSION['numbercast'])){ foreach($_SESSION['numbercast'] as $key => $type) { if($key == 'H2' ){ foreach($_SESSION['numbercast'][$key] as $keyvalue => $valuefix) { if($valuefix == $value){ echo 'checked'; } } } } }?>/>
                              <?php
                              }else{
                              ?>
                              <input disabled type="checkbox" name="A" class="a" value="<?php echo $value; ?>" onclick="oncheckNumber(this,'H2','1')" <?php if(isset($_SESSION['numbercast'])){ foreach($_SESSION['numbercast'] as $key => $type) { if($key == 'H2' ){ foreach($_SESSION['numbercast'][$key] as $keyvalue => $valuefix) { if($valuefix == $value){ echo 'checked'; } } } } }?>/>  
                              <?php
                              }
                            }
                            ?>
                            </div>
                            <?php
                          }
                        ?>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายการเล่น</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ราคาที่จะซื้อ <span class="required" style="color:Red;">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="pricesell" name="pricesell" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pricesell">บาท
                      </div>
                      <br>
                      <hr>
                      <div class="stepContainer" style="overflow: auto;" style="height:100%;">
                        <div id="cast_market">
                        </div>
                      </div>
                      <div class="row no-print">
                        <div class="col-xs-12" >
                          <hr>
                          <h3 id="total_sell" style="text-align: center;"></h3>
                          <br>
                          <button id="clearcast" class="btn btn-round btn-danger"><i class="fa fa-recycle"></i> รีเซตข้อมูล</button>
                          <button id="submitcast" onclick="submitcase()" class="btn btn-round btn-success pull-right" ><i class="fa fa-money"></i> ลงเดิมพัน</button>
                        </div>
                      </div>
                        
                  </div>
                </div>
              </div>

                      
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <script src="../js/sell_user.js"></script>
              <script>
                this.changenumber('<?php if(isset($_SESSION['changenumber']) && $_SESSION['changenumber'] == 'on'){ echo 'change'; }else{ echo 'notchange'; } ?>','H2','2','1');
              </script>
        