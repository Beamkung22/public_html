<?php 
session_start();
if($_POST['lennumber'] == 1) {?>
    <label class="btn btn-danger active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(1,'H',1)">
        <input type="radio" name="gender" value="male" checked> บน
    </label>
    <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(1,'L',1)">
        <input type="radio" name="gender" value="female"> ล่าง
    </label>
<?php }else if($_POST['lennumber'] == 2) {?>
    <label class="btn btn-danger active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(2,'H',1)">
        <input type="radio" name="gender" value="male" checked> บน
    </label>
    <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:50%;" onclick="oncheckdataNumber(2,'L',1)">
        <input type="radio" name="gender" value="female"> ล่าง
    </label>
<?php }else if($_POST['lennumber'] == 3) {?>
    <label class="btn btn-danger active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:33.33%;" onclick="oncheckdataNumber(3,'H',1)">
        <input type="radio" name="gender" value="male" checked> บน
    </label>
    <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:33.33%;" onclick="oncheckdataNumber(3,'L',1)">
        <input type="radio" name="gender" value="female"> ล่าง
    </label>
    <label class="btn btn-dark" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" style="width:33.33%;" onclick="oncheckdataNumber(3,'T',1)">
        <input type="radio" name="gender" value="female"> โต๊ด
    </label>
<?php } ?>