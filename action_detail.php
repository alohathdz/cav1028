<?php
require("mysql/connect.php");
$result=$con->prepare("SELECT em.*,db_po.p_fname,ra.r_aname,sa.* FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) left join salary sa ON(em.e_salary = sa.sid) WHERE eid='$eid'");
$result->execute();
$row=$result->fetch(PDO::FETCH_ASSOC);
$eid=$row['eid']; /* เลขบัตรประชาชน */
$rank=$row['r_aname']; // ยศ
$rid=$row['e_rank']; // รหัสยศ
$firstname=$row['e_firstname']; /* ชื่อ */
$lastname=$row['e_lastname']; /* สกุล */
$idarmy=$row['e_idarmy']; /* เลข 10 หลัก ทหาร */
$corps=$row['e_corps']; /* เหล่า */
$origin=$row['e_origin']; // กำเนิด
$birthday=$row['birthday']; // วันเกิด
$position=$row['p_fname']; /* ตำแหน่ง */
$pid=$row['e_pid']; // เลขตำแหน่ง
$salary=$row['s_name']." ( ".$row['s_money']." )"; // เงินเดือน
$sid=$row['e_salary']; // id เงินเดือน
$ephoto="photos/".$eid.".jpg"; /* รูปภาพ */
require("mysql/uncon.php");
?>