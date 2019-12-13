<?php
try {
	$con=new PDO($dsn, $dbuser, $dbpass);
	//echo 'เชื่อมต่อฐานข้อมูลแล้ว';
} catch (Exception $exc) {
	echo $exc->getTraceAsString();
}
?>