<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
?>

                  <?php 
                  $numPop = 0;
                  $_POST['lesson'] ='07bf9734-ac27-11eb-b588-2cfda1bb2bab';
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
