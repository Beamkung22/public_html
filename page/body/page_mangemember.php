    <!-- validator -->
          <div class="x_panel">
                  <div class="x_title">
                    <h2>Register <small>สมัครสมาชิก</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อ-สกุล <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="ชื่อนามสกุล" required="required" type="text">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">เบอร์โทร <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="accountno">เลขบัญชี <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="accountno" name="accountno" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะ<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="heard" name="status" class="form-control" required>
                            <option value="">กรุณาเลือกสถานะ..</option>
                            <?php 
                        $sqld=" select * from lotto_config where lotto_type = 'status_user' and active_flg = 'Y' ";
                        $rsd=$cls_conn->select_base($sqld);
                        while($status=mysqli_fetch_array($rsd))
                        {
                        ?>
                        <option value="<?php echo $status['row_id']; ?>"><?php echo $status['lotto_name']; ?></option>
                            <?php 
                        } 
                        ?>
                            </select>  
                            </div>    
                        </div> 
                        <div class="ln_solid"></div>
                        <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                        </div>
                        </form>
                  </div>
                </div>
                <?php
                        if(isset($_POST['username']))
                        {
                                $name=$_POST['name'];
                                $email=$_POST['email'];
                                $tel=$_POST['phone'];
                                $username=$_POST['username'];
                                $password=$_POST['password'];
                                $credit=0;
                                $status=$_POST['status'];
                                $accountno=$_POST['accountno'];
                                $class='d9cfdd39-1c4e-11eb-b684-2cfda1bb2bab';
                                
                        $salt         = getSalt();
			//Generate a unique password Hash
			$passwordHash = password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT);
            
            //Query to register new user
            $sql = "INSERT INTO `member` (`row_id`, `name`, `username`, `password`, `tel`, `status`, `class`, `credit`, `salt`, `Email`, `accountno`) VALUES ";
            $sql.= "(UUID(), '$name','$username','$passwordHash','$tel','$status','$class','$credit','$salt','$email','$accountno')";
            $username = trim($username);
            if(!is_null($username)){
                $sqlu=" select * from member";
                $sqlu.=" where";
                $sqlu.=" username='$username'";
                $rsu=$cls_conn->select_base($sqlu);
                $rowu=mysqli_fetch_array($rsu);
                if(!isset($rowu['row_id'])){
                    if($cls_conn->write_base($sql)==true)
                        {  
                            echo $cls_conn->show_message('บันทึกข้อมูลสำเร็จ');
                            //echo $sql;
                        }
                        else
                        {
                            echo $cls_conn->show_message('บันทึกข้อมูลไม่สำเร็จ');
                            echo $sql;
                        }         
                }else{
                    echo $cls_conn->show_message('UserName ซ้ำกรุณาเปลี่ยน');
                }   
            }                
        }
                        ?>

                  
                        