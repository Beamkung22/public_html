<?php 
session_start();
if($_POST['action'] == "change"){ 
    $_SESSION['changenumber_setting'] = "on"; ?>
                        <br>
<button data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" type="button"> สลับตัวเลข <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">
                            <li><a id="changedata" onclick="changenumber('notchange')">ไม่สลับตัวเลข</a>
                            </li>
                          </ul>
<?php }else if($_POST['action'] == "notchange"){ 
    $_SESSION['changenumber_setting'] = "off"; ?>
                        <br>
<button data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" type="button"> ไม่สลับตัวเลข <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">
                            <li><a id="changedata" onclick="changenumber('change')">สลับตัวเลข</a>
                            </li>
                          </ul>          
<?php } ?>