<?php
class class_conn{
//ตั้งฐานข้อมูล
public $db_server = "localhost";
public $db_username = "lotty417_admin";
public $db_password = "Lotty@2417";
public $db_database = "lotty417_lotto";
//ฟังก์ชั่นในการเรียกดูข้อมูล จะใช้กับ select ต่างๆ
public function connext_db(){
	$db_server = $this->db_server;//เรียกตัวแปร db_server จาก public มาใส่ใน $db_server ในฟังก์ชั่น
	$db_username = $this->db_username;
	$db_password = $this->db_password;
	$db_database = $this->db_database;
	$con = mysqli_connect($db_server,$db_username,$db_password,$db_database);
	mysqli_set_charset($con,"utf8");
	return $con;
}

public function select_base($sql){
$db_server = $this->db_server;//เรียกตัวแปร db_server จาก public มาใส่ใน $db_server ในฟังก์ชั่น
$db_username = $this->db_username;
$db_password = $this->db_password;
$db_database = $this->db_database;
$con = mysqli_connect($db_server,$db_username,$db_password,$db_database);
mysqli_set_charset($con,"utf8"); //set ข้อมูลในฐานข้อมูลเป็นภาษาไทย
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: ". mysqli_connect_error();
}
$result = mysqli_query($con,$sql);
return $result; 
mysqli_close($con); 
}
//ฟังก์ชั่นในการเพิ่ม/ลบ/แก้ไขข้อมูลลงฐานข้อมูลใช้กับคำสั่ง insert,delete,update
public function write_base($sql){
$db_server = $this->db_server;//เรียกตัวแปร db_server จาก public มาใส่ใน $db_server ในฟังก์ชั่น
$db_username = $this->db_username;
$db_password = $this->db_password;
$db_database = $this->db_database;
$con = mysqli_connect($db_server,$db_username,$db_password,$db_database);
mysqli_set_charset($con,"utf8"); //set ข้อมูลในฐานข้อมูลเป็นภาษาไทย
if(mysqli_connect_errno())
{
	return false;
}
else{
	mysqli_query($con,$sql);
	mysqli_close($con);
	return true;
}


}
//ฟังก์ชั่นในการนับจำนวนแถว
public function select_numrows($sql){
$db_server = $this->db_server;//เรียกตัวแปร db_server จาก public มาใส่ใน $db_server ในฟังก์ชั่น
$db_username = $this->db_username;
$db_password = $this->db_password;
$db_database = $this->db_database;
$con = mysqli_connect($db_server,$db_username,$db_password,$db_database);
mysqli_set_charset($con,"utf8"); //set ข้อมูลในฐานข้อมูลเป็นภาษาไทย
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: ". mysqli_connect_error();
}
$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);
return $rowcount;
mysqli_close($con);
}

//ฟังก์ชั่นแสดงข้อความ
public function show_message($word){
    return "<script type='text/javascript'>alert('$word');</script>";
}
//ฟังก์ชั่นในการลิงค์ไปหน้าอื่น
public function goto_page($speed,$url){
    return "<meta http-equiv='refresh' content='$speed;$url' />";
}
public function change_type_data($type){
	$StatusName = "";
	if($type == "บน2"){ 
		$StatusName = "H2";
	}else if($type == "ล่าง2"){
		$StatusName = "L2";
	}else if($type == "บน3"){
		$StatusName = "H3";
	}else if($type == "ล่าง3"){
		$StatusName = "L3";
	}else if($type == "โต๊ด"){
		$StatusName = "T3";
	}else if($type == "วิ่งบน"){
		$StatusName = "H1";
	}else if($type == "วิ่งล่าง"){
		$StatusName = "L1";
	}
	return $StatusName;
}

}
?>