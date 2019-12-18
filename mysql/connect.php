<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="01545";
$dbname="cav1028";
$dsn="mysql:host=localhost;dbname=cav1028";
try {
	$con=new PDO($dsn, $dbuser, $dbpass);
	//echo 'เชื่อมต่อฐานข้อมูลแล้ว';
} catch (Exception $exc) {
	echo $exc->getTraceAsString();
}
?>