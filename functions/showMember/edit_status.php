<?php 
include('../../connect/class_conn.php');
$cls_conn=new class_conn;
include('../logicmain.php');
$change_language=new change_language;
$oldstatus = $_POST['oldstatus'];
                              $sqld=" select * from lotto_config where lotto_type = 'status_user' and active_flg = 'Y' ";
                              $rsd=$cls_conn->select_base($sqld);
                              while($status=mysqli_fetch_array($rsd))
                              {
                                if($status['row_id'] == $oldstatus){
                                ?>
                                <option selected value="<?php echo $status['row_id']; ?>"><?php echo $change_language->change_Status_member($status['lotto_name']); ?></option>
                                <?php
                                    }else{
                                ?>
                                <option value="<?php echo $status['row_id']; ?>"><?php echo $change_language->change_Status_member($status['lotto_name']); ?></option>
                                    <?php 
                                    }
                              } 
                              ?>