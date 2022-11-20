<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายชื่อบุคคลากร </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form method="post">
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group" style="width:20%;">
                      <select name="statusMenber" class="form-control">
                              <option value="">กรุณาเลือกตำแหน่งของบุคคลากร..</option>
                              <?php 
                              $sqlstatusMe=" select lc.* from lotto_config lc where lc.lotto_type = 'status_user'";
                              $rsdstatusMe=$cls_conn->select_base($sqlstatusMe);
                              while($statusMe=mysqli_fetch_array($rsdstatusMe))
                                { 
                              ?>
                              <option value="<?php echo $statusMe['row_id']; ?>"><?php echo $change_language->change_Status_member($statusMe['lotto_name']); ?></option>
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
                  if(isset($_POST['statusMenber']) && $_POST['statusMenber'] != ''){
                    $rowIdStatus = $_POST['statusMenber'];
                    $sqlstatus=" select lc.lotto_name status 
                        from 
                        lotto_config lc
                        where 
                        lc.row_id = '$rowIdStatus' ";
                        $rsdstatus=$cls_conn->select_base($sqlstatus);
                        $status=mysqli_fetch_array($rsdstatus);
                  ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ชื่อนามสกุล</th>
                          <th>สถานะ</th>
                          <th>เบอร์โทร</th>
                          <th>อีเมล์</th>
                          <th>จำนวนเงิน</th>
                          <?php 
                          if($status['status'] != "customer"){
                            ?><th>ระดับ</th><?php
                          }
                          ?>
                          <th>แก้ไข</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sqld=" select m.row_id memberid ,
                        m.name,
                        m.tel,
                        m.Email,
                        m.credit,
                        lc.lotto_name status , 
                        m.status statusid ,
                        m.class classid ,
                        c.name class
                        from 
                        member m, 
                        lotto_config lc,
                        class c
                        where 
                        m.status = lc.row_id
                        and m.class = c.row_id 
                        and m.status = '$rowIdStatus' ";
                        $rsd=$cls_conn->select_base($sqld);
                        while($member=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $member['name']; ?></td>
                          <td><?php echo $change_language->change_Status_member($member['status']); ?></td>
                          <td><?php echo $member['tel']; ?></td>
                          <td><?php echo $member['Email']; ?></td>
                          <td><?php echo number_format($member['credit'])." ฿"; ?></td>
                          <?php 
                          if($member['status'] != "customer"){
                            ?><td><?php echo $member['class']; ?></td><?php } ?>
                          <td><a onclick="mainmenu('<?php echo $member['memberid']; ?>')" ><i class="fa fa-edit"></i></a></td>
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
<?php include('popup/profile/popup_mainmanu.php'); ?>
<?php include('popup/profile/popup_editprofile.php'); ?>
<?php include('popup/profile/popup_changepassword.php'); ?>
<?php include('popup/profile/popup_credit.php'); ?>

<script src="../js/manage_profile_1.js">
</script>
