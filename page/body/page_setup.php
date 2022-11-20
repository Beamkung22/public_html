<!-- validator -->
<div id="myNav" class="overlay">
    <div class="loader"></div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>TimeOpen - Close <small>ตั้งค่าเวลาเปิด-ปิด</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <form class="form-horizontal form-label-left" id="sample_form">
        <p>กรุณาทำตามขั้นตอนการเปิดร้าน เพื่อไม่ได้เกิดบัค.</p>
        <div id="wizard" class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
                <li>
                    <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                            Step 1<br />
                            <small>1.การตั้งค่าเปิดร้าน</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                            Step 2<br />
                            <small>2.กำหนด วันเปิดปิดร้าน</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                            Step 3<br />
                            <small>3.ตั้งค่าเงินรางวัล</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-4">
                        <span class="step_no">4</span>
                        <span class="step_descr">
                            Step 4<br />
                            <small>4.ตั้งค่าตัวเลข อั่นเท่าที่จ่าย</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-5">
                        <span class="step_no">5</span>
                        <span class="step_descr">
                            Step 5<br />
                            <small>5.ตั้งค่าตัวเลข อั้นเท่าที่ขาย</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-6">
                        <span class="step_no">6</span>
                        <span class="step_descr">
                            Step 6<br />
                            <small>6.การยืนยันเปิดร้าน</small>
                        </span>
                    </a>
                </li>
            </ul>
            <div id="step-1">
                <h2 class="StepTitle">การตั้งค่าเปิดร้าน</h2>
                <p>วิธีการตั้งค่าเปิดร้าน</p>
                <p>1. กำหนดวันที่เปิด และ ปิดร้าน ในช่วงเวลาที่ต้องการ (โดยระบบจะสามารถใส่ หน่วยนาที ได้แค่ 30 และ 00
                    นาทีเท่านั้น)</p>
                <p>2. กำหนดเงินรางวัล โดยจะแบ่งออกเป็น บน2 ล่าง2 บน3(ตรง) ล่าง3 โต๊ด วิ่ง</p>
                <p>3. ระบบจะทำการนำข้อมูลที่กรอก ใน Step 2 และ 3 เข้าสู่ฐานข้อมูล
                    กรุณาตรวจสอบความถูกต้องให้เรียบร้อยก่อนไป Step 4
                    เพราะจะไม่สามารถย้อนกลับมาแก้ไขข้อมูลได้หลังจากกดยืนยัน</p>
                <p>4. กำหนดค่า อั้น สำหรับการจ่ายเงินรางวัล โดยเลือก ประเภท และ ตัวเลขที่ต้องการอั้น จากนั้นใส่
                    จำนวนเงินรางวัล (คิดเป็น 1ต่อ (จำนวนที่ใส่) บาท )</p>
                <p>5. กำหนดจำนวน อั้นในการขาย (จะขายทั้งหมดเท่าไหร่) โดย เลือก ประเภท และ ตัวเองที่ต้องการอั้น
                    จากนั้นใส่ จำนวนเงินที่ต้องการอั้น (ขายทั้งหมดเท่าไหร่)</p>
                <p>6. ตรวจสอบข้อมูล ใน Step 4 และ 5 เรียบร้อย และ กดติ๊ก ตรวจสอบข้อมูลแล้ว จากนั้นกดปุ่ม Finish</p>
                <p>7. ระบบจะทำการเพิ่มข้อมูลเข้าสู่ฐานข้อมูลอีกครั้ง เมื่อแถบดาวน์โหลด
                    ก็ถือเสร็จสิ้นการตั้งค่าเปิดร้านเรียบร้อย</p>
            </div>
            <div id="step-2">
                <h2 class="StepTitle">กำหนด วันเปิดปิดร้าน</h2>
                <p>
                    วันที่เปิดร้าน ควรกรอกข้อมูลที่จะเปิดร้าน <b style="color:red"> ให้ครบถ้วน </b>
                    เพื่อจะได้จัดเตรียมข้อมูลก่อนการเปิดร้าน
                </p>
                <b style="color:red"> * </b>ชื่อรอบ :
                <input type="text" class="form-control" id="nameproject" name="nameproject" />
                <br>
                <b style="color:red"> * </b>เวลาเปิด-ปิด :
                <input type="text" class="form-control" value="<?php echo $Strdate; ?>" name="reservation-time"
                    id="reservation-time" />
            </div>
            <div id="step-3">
                <?php 
                        $sqlstatusConfig=" select lc.lotto_name , lc.lotto_val1 from lotto_config lc where lc.lotto_type = 'price_project' ";
                        $rsdstatusConfig=$cls_conn->select_base($sqlstatusConfig);
                        $H1 = 0;
                        $L1 = 0;
                        $H2 = 0;
                        $L2 = 0;
                        $H3 = 0;
                        $L3 = 0;
                        $T3 = 0;
                        while($statusConfig=mysqli_fetch_array($rsdstatusConfig))
                          { 
                            if($statusConfig['lotto_name'] == "H1"){
                              $H1 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "L1"){
                              $L1 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "H2"){
                              $H2 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "L2"){
                              $L2 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "H3"){
                              $H3 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "L3"){
                              $L3 = $statusConfig['lotto_val1'];
                            }else if($statusConfig['lotto_name'] == "T3"){
                              $T3 = $statusConfig['lotto_val1'];
                            }
                          }
                        ?>
                <h2 class="StepTitle">ตั้งค่าเงินรางวัล</h2>
                <p>
                    กำหนดค่าเงินรางวัล เริ่มต้น
                    <br>
                    <b style="color:red">หมายเหตุ*** ค่าที่ใส่นั้นเป็นค่าของ "ตัวคูณ" เงินรางวัล</b>
                </p>
                บน2 :
                <input type="number" value="<?php echo $H2; ?>" name="priceh2" id="priceh2" class="form-control">
                ล่าง2 :
                <input type="number" value="<?php echo $L2; ?>" name="pricel2" id="pricel2" class="form-control">
                บน3 :
                <input type="number" value="<?php echo $H3; ?>" name="priceh3" id="priceh3" class="form-control">
                ล่าง3 :
                <input type="number" value="<?php echo $L3; ?>" name="pricel3" id="pricel3" class="form-control">
                โต๊ด :
                <input type="number" value="<?php echo $T3; ?>" name="pricet" id="pricet" class="form-control">
                วิ่งบน :
                <input type="number" value="<?php echo $H1; ?>" name="priceh1" id="priceh1" class="form-control">
                วิ่งล่าง :
                <input type="number" value="<?php echo $L1; ?>" name="pricel1" id="pricel1" class="form-control">

            </div>
            <div id="step-4">
                <h2 class="StepTitle">ตั้งค่าตัวเลข อั้นเท่าที่จ่าย</h2>
                ประเภทตัวเลข :
                <select id="typenumber" class="form-control" required>
                    <option value="">กรุณาเลือกประเภท..</option>
                    <option value="H2-L2">2ตัวบน-ล่าง</option>
                    <option value="H3">3ตัวบน</option>
                    <option value="L3">3ตัวล่าง</option>
                    <option value="T3">โต๊ด</option>
                    <option value="H1">วิ่งบน</option>
                    <option value="L1">วิ่งล่าง</option>
                </select>
                จำนวนที่อั้น :
                <input type="number" value="0" name="price" id="price" class="form-control">
                เลือกตัวเลขแบบ :
                <select id="typechange" class="form-control" required>
                    <option id="notchangeedit" value="notchange">ไม่สลับตัวเลข</option>
                    <option id="changeedit" value="change">สลับตัวเลข</option>
                </select>
                <div id="numberall" style="width:100%; margin: auto;">
                </div>
                <?php /*  
                        ตัวเลข : 
                        <select id="numberall" class="form-control" required>
                            <option value="">กรุณาเลือกเลข..</option>
                          </select>
                          */ ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <hr>
                    <div id="viewData" style="height: 500px;">
                    </div>
                </div>
            </div>
            <div id="step-5">
                <h2 class="StepTitle">ตั้งค่าตัวเลข อั้นเท่าที่ขาย</h2>
                ประเภทตัวเลข :
                <select id="typenumbersell" class="form-control" required>
                    <option value="">กรุณาเลือกประเภท..</option>
                    <option value="H2">2ตัวบน</option>
                    <option value="L2">2ตัวล่าง</option>
                    <option value="H3">3ตัวบน</option>
                    <option value="L3">3ตัวล่าง</option>
                    <option value="T3">โต๊ด</option>
                    <option value="H1">วิ่งบน</option>
                    <option value="L1">วิ่งล่าง</option>
                </select>
                <?php /* 
                        ตัวเลข : 
                        <select id="numberallsell" class="form-control" required>
                            <option value="">กรุณาเลือกเลข..</option>
                          </select>
                        */ ?>
                จำนวนที่อั้น :
                <input type="number" value="0" name="pricesell" id="pricesell" class="form-control">
                เลือกตัวเลขแบบ :
                <select id="typechangesell" class="form-control" required>
                    <option id="notchangesell" value="notchange">ไม่สลับตัวเลข</option>
                    <option id="changesell" value="change">สลับตัวเลข</option>
                </select>
                <div id="numberdataSell" style="width:100%; margin: auto;">
                </div>
                <?php /* 
                        ตัวเลข : 
                        <select id="numberallsell" class="form-control" required>
                            <option value="">กรุณาเลือกเลข..</option>
                          </select>
                        */ ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <hr>
                    <div id="viewDataSell" style="height: 500px;">
                    </div>
                </div>
            </div>
            <div id="step-6">
                <h2 class="StepTitle">การยืนยันเปิดร้าน</h2>
                <p>ตรวจสอบข้อมูล เสร็จเรียบร้อยแล้ว กรุณากดติดเช็คบล็อกข้างล่างเพื่อทำการ เปิดร้านขายของ
                </p>
                <input type="checkbox" id="check" />
                <label for="check">ตรวจสอบเสร็จแล้ว</label>
            </div>
        </div>
</div>
</div>
</form>
<script>
function checkdateOpenProject(count_error) {
    var date = false;
    var nameproject = document.getElementById("nameproject").value;
    if (nameproject == "") {
        count_error++;
        alert("กรุณากรอกชื่อรอบ");
        document.getElementById("nameproject").focus();
    } else {
        var res = document.getElementById("reservation-time").value.split("-");
        <?php 
                          $sqld=" select t.*
                            from 
                            lotto_time t ";
                            $rsd=$cls_conn->select_base($sqld);
                            while($time=mysqli_fetch_array($rsd))
                            { 
                              echo 'if(dateCompare("'.$time["time_open"].'","'.$time["time_close"].'",res[0])){';
                              echo 'count_error++;';
                              echo 'date = true;';
                              echo 'alert("กรุณาอย่ากรอกวันทับกัน");';
                              echo '}';
                            }
                          ?>
        if (date && count_error != 0) {
            document.getElementById("reservation-time").value = "";
            document.getElementById("reservation-time").focus();
        }
    }
    return count_error;
}

function checkdateOpen() {
    var c_error = 0;
    var res = document.getElementById("reservation-time").value.split("-");
    <?php 
                        $sqld=" select t.*
                          from 
                          lotto_time t ";
                          $rsd=$cls_conn->select_base($sqld);
                          while($time=mysqli_fetch_array($rsd))
                          { 
                            echo 'if(dateCompare("'.$time["time_open"].'","'.$time["time_close"].'",res[0])){';
                            echo 'c_error++;';
                            echo 'alert("กรุณาอย่ากรอกวันทับกัน");';
                            echo '}';
                          }
                          
                        ?>
    if (c_error == 0 && dateCompareCur(res[0])) {
        c_error++;
        alert("กรุณาอย่ากรอกวันที่เป็นอดีต");
    }

    if (c_error != 0) {
        document.getElementById("reservation-time").value = "";
        document.getElementById("reservation-time").value.focus();
    }
}
</script>
<script src="../js/setting_projects.js"></script>