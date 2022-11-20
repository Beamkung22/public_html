<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
                  $numrow = 0;
                  $pagenum = 0;
                  $pageKeyName = "";
                  $pagehole = $_POST['pagenum'];
                  $lennum = $_POST['lennumber'];
                  if(isset($_POST['numberdata']) && $_POST['numberdata'] != ''){
                    $numbersearch = $_POST['numberdata'];
                  }
                  
                  $typenumber = $_POST['typenumber'].$lennum;
                  //Query Product ALL
                  $sqlItem_pro=" select p.name , p.row_id , p.flag_fix , p.price_fix from lotto_product p where p.type = '$typenumber' ";
                  $sqlItem_pro.=" and p.time_id = '$rowIdTime' ";
                  if(isset($numbersearch) && $numbersearch != ''){
                    $sqlItem_pro.=" and p.name like '%$numbersearch%' ";
                  }
                  $sqlItem_pro.=" order by p.name asc ";
                  $rsdItem_pro=$cls_conn->select_base($sqlItem_pro);
                  while($item_pro=mysqli_fetch_array($rsdItem_pro)){
                      $numrow++;
                      if($numrow == 1){
                        $pageKeyName = $item_pro['name'];
                        //$pageName[$pagenum] = $item_pro['name']
                      }
                      $pageDataShowA[$pageKeyName][$numrow] = $item_pro['name'];
                      $pageflagfix[$pageKeyName][$numrow] = $item_pro['flag_fix'];
                      $pagenumberfix[$pageKeyName][$numrow] = $item_pro['price_fix'];
                      if($numrow == 100){
                        $numrow = 0;
                        $pageKeyName = "";
                      }
                  }
                  ?>
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php 
                        $num = 0;
                        foreach($pageDataShowA as $key => $one) {
                        $num++; ?>
                        <li role="presentation" <?php if($num == $pagehole){ echo "class='active'"; }else{ echo "class=''";} ?>><a href="#tab_content<?php echo $num; ?>" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" onclick="pagecurrent('<?php echo $num; ?>','<?php echo $typenumber; ?>','<?php echo $lennum; ?>')"><?php echo $key; ?></a>
                        </li>
                        <?php } ?>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <?php 
                        $numValue = 0;
                          foreach($pageDataShowA as $key => $one) {
                            $headkey = $key;
                            $numValue++;
                            ?>
                            <div role="tabpanel" <?php if($numValue == $pagehole){ echo "class='tab-pane fade active in'"; }else{ echo "class='tab-pane fade'";} ?> id="tab_content<?php echo $numValue; ?>" aria-labelledby="home-tab">
                            <?php
                            foreach($pageDataShowA[$key] as $keys => $value) {
                              if ($pageflagfix[$headkey][$keys] == "N" 
                                  ||  ($pageflagfix[$headkey][$keys] == "Y" && $pagenumberfix[$headkey][$keys] > 0)){
                              ?>
                              <input type="checkbox" name="A" class="a" value="<?php echo $value; ?>" onclick="oncheckNumber(this,'<?php echo $typenumber; ?>','<?php echo $numValue; ?>')" <?php if(isset($_SESSION['numbercast'])){ foreach($_SESSION['numbercast'] as $key => $type) { if($key == $typenumber ){ foreach($_SESSION['numbercast'][$key] as $keyvalue => $valuefix) { if($valuefix == $value){ echo 'checked'; } } } } }?>/>
                              <?php
                              }else{
                              ?>
                              <input disabled type="checkbox" name="A" class="a" value="<?php echo $value; ?>" onclick="oncheckNumber(this,'<?php echo $typenumber; ?>','<?php echo $numValue; ?>')" <?php if(isset($_SESSION['numbercast'])){ foreach($_SESSION['numbercast'] as $key => $type) { if($key == $typenumber ){ foreach($_SESSION['numbercast'][$key] as $keyvalue => $valuefix) { if($valuefix == $value){ echo 'checked'; } } } } }?>/>
                              <?php
                              }
                            }
                            ?>
                            </div>
                            <?php
                          }
                        ?>
                      </div>