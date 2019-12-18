<?php
require("mysql/connect.php");
$result=$con->prepare("SELECT em.*,db_po.p_fname,ra.r_aname,sa.* FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) left join salary sa ON(em.e_salary = sa.sid) WHERE eid='$eid'");
$result->execute();
$record=$result->fetch(PDO::FETCH_ASSOC);
$eid=$record['eid']; /* เลขบัตรประชาชน */
$rank=$record['r_aname']; // ยศ
$firstname=$record['e_firstname']; /* ชื่อ */
$lastname=$record['e_lastname']; /* สกุล */
$idarmy=$record['e_idarmy']; /* เลข 10 หลัก ทหาร */
$corps=$record['e_corps']; /* เหล่า */
$origin=$record['e_origin']; // กำเนิด
$birthday=$record['birthday']; // วันเกิด
$position=$record['p_fname']; /* ตำแหน่ง */
$salary=$record["s_name"]." ( ".$record["s_money"]." )"; // เงินเดือน
$ephoto="photos/".$eid.".jpg"; /* รูปภาพ */
require("mysql/uncon.php");
?>