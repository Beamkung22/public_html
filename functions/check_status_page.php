<?php
if(isset($_SESSION['status']) && $_SESSION['status'] != "admin") {
    session_destroy();
    echo $cls_conn->show_message('คุณไม่มีสิทธิของคุณไม่ถึงที่จะใช้หน้านี้');
    echo $cls_conn->goto_page(1,'page_login.php');
    exit;
}
?>