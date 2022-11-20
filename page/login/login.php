<?php

$response = array();

$passwordHashDB;

include 'functions/functions.php';

//Check for Mandatory parameters

if(isset($_POST['username']) && isset($_POST['password'])){

	$username = $_POST['username'];

	$password = $_POST['password'];

	$query = "SELECT m.*,lc.lotto_name FROM member m , lotto_config lc WHERE m.username = '$username' and lc.active_flg = 'Y' and m.status = lc.row_id";

	$list = $cls_conn->select_base($query);

	if($list == true){

		$row = mysqli_fetch_array($list);

		$salt = $row['salt'];

		$passwordHashDB = $row['password'];

		password_verify(concatPasswordWithSalt($password,$salt),$passwordHashDB);

		if(password_verify(concatPasswordWithSalt($password,$salt),$passwordHashDB)){

				echo $cls_conn->show_message('ยินดีตอนรับเข้าสู่ระบบ');

				$_SESSION['id_member'] = $row['row_id'];

				$_SESSION['status_m'] = $row['lotto_name'];

				if($row['lotto_name'] == "admin"){

					echo $cls_conn->goto_page(1,'page/setup');

				}else{

					echo $cls_conn->goto_page(1,'page/showaward');
				}
				exit;

			}else{

				echo $cls_conn->show_message('รหัสคุณกรอกไม่ถูกต้อง');

			}

		}

		else{

		//"Invalid username and password combination"

			echo $cls_conn->show_message('รหัสคุณกรอกไม่ถูกต้อง');

		}

}

?>