<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>งวดทั้งหมด </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php 
                  $numPop = 0;
                  ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ลำดับ</th>
                          <th>ชื่อรอบ</th>
                          <th>เวลาเปิด</th>
                          <th>เวลาปิด</th>
                          <th>สถานะ</th>
                          <th>แก้ไข</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sqld=" select lt.* 
                        from 
                        lotto_time lt ";
                        $rsd=$cls_conn->select_base($sqld);
                        while($config=mysqli_fetch_array($rsd))
                       {
                         $numPop++;
                      ?>
                        <tr>
                          <td><?php echo $numPop; ?></td>
                          <td><?php echo $config['name']; ?></td>
                          <td><?php echo $config['time_open']; ?></td>
                          <td><?php echo $config['time_close']; ?></td>
                          <td><?php echo $config['status']; ?></td>
                          <td> <a onclick="editSetting('<?php echo $config['row_id']; ?>')" ><i class="fa fa-edit"></i></a></td>
                        <?php 
                       }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
<?php include('popup/popup_editTime.php'); ?>
<script src="../js/manage_listTime.js">
</script>