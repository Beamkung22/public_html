<?php 
if(!isset($_SESSION['id_member']) || $_SESSION['id_member'] == ''){  
    echo $cls_conn->show_message('กรุณา Login ก่อนเข้าใช้งาน'. $_SESSION['id_member']);
    echo $cls_conn->goto_page(1,'/');
    exit;
}
if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_destroy();   // destroy session data in storage
    echo $cls_conn->goto_page(1,'/');
}
$_SESSION['LAST_ACTIVITY'] = time();
?>