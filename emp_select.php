<?php
$sql="SELECT eid,e_rank,e_firstname,e_lastname,e_idarmy,e_pid,e_salary FROM employee WHERE eid='$eid'";
require("mysql/connect.php");
$result=$con->prepare($sql);
$result->execute();
$record=$result->fetch();
//$result=mysql_query($sql);
//$record=mysql_fetch_array($result);
$eid=$record['eid']; /* เลขบัตรประชาชน */
$rank=$record['e_rank']; // ยศ
$firstname=$record['e_firstname']; /* ชื่อ */
$lastname=$record['e_lastname']; /* สกุล */
$idarmy=$record['e_idarmy']; /* เลข 10 หลัก ทหาร */
$pid=$record['e_pid']; /* เลขตำแหน่ง */
$salary=$record['e_salary']; // เงินเดือน
$ephoto="photos/".$eid.".jpg"; /* รูปภาพ */
require("mysql/uncon.php");
?>