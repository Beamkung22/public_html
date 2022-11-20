<?php 
session_start();
if($_POST['action'] == "change"){ 
    $_SESSION['changenumber'] = "on"; ?>
    <div class="col-md-6 col-sm-6 col-xs-12">
                          Search : <input type="text" id="searchnumber" class="form-control col-md-7 col-xs-12" >
                        </div>
                        <br>
<button data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" type="button"> สลับตัวเลข <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">
                            <li><a id="changedata" onclick="changenumber('notchange','<?php if(!isset($_SESSION['currenttype']) || $_SESSION['currenttype'] == ''){ echo 'H';}else{echo $_SESSION['currenttype'];} ?>','<?php if(!isset($_SESSION['currentlen']) || $_SESSION['currentlen'] == ''){ echo '2';}else{echo $_SESSION['currentlen'];} ?>','<?php if(!isset($_SESSION['currentpage']) || $_SESSION['currentpage'] == ''){ echo '1';}else{echo $_SESSION['currentpage'];} ?>')">ไม่สลับตัวเลข</a>
                            </li>
                          </ul>
<?php }else if($_POST['action'] == "notchange"){ 
    $_SESSION['changenumber'] = "off"; ?>
    <div class="col-md-6 col-sm-6 col-xs-12">
                          Search : <input type="text" id="searchnumber" class="form-control col-md-7 col-xs-12" >
                        </div>
                        <br>
<button data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" type="button"> ไม่สลับตัวเลข <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">
                            <li><a id="changedata" onclick="changenumber('change','<?php if(!isset($_SESSION['currenttype']) || $_SESSION['currenttype'] == ''){ echo 'H';}else{echo $_SESSION['currenttype'];} ?>','<?php if(!isset($_SESSION['currentlen']) || $_SESSION['currentlen'] == ''){ echo '2';}else{echo $_SESSION['currentlen'];} ?>','<?php if(!isset($_SESSION['currentpage']) || $_SESSION['currentpage'] == ''){ echo '1';}else{echo $_SESSION['currentpage'];} ?>')">สลับตัวเลข</a>
                            </li>
                          </ul>          
<?php } ?>