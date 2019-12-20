<html>

<head>
	<meta charset="utf-8">
	<title>Cavalry Management System</title>
</head>

<body>
	<?php
	$oid = $_POST['oid']; /* เลขบัตรประชาชน เก่า */
	$opid = $_POST['opid']; // เลขตำแหน่งเก่า
	$eid = $_POST['eid']; /* เลขบัตรประชาชน */
	$rank = $_POST['rank']; // ยศ
	$firstname = $_POST['firstname']; /* ชื่อ */
	$lastname = $_POST['lastname']; /* สกุล */
	$idarmy = $_POST['idarmy']; /* เลข 10 หลัก ทหาร */
	$corps = $_POST['corps']; // เหล่า
	$origin = $_POST['origin']; // กำเนิด
	$birthday = $_POST['birthday']; // วันเกิด
	$position = $_POST['position']; // เลขตำแหน่ง
	$salary = $_POST['salary']; // เงินเดือน
	$oldphoto = "photos/" . $oid . ".jpg";
	$newphoto = "photos/" . $eid . ".jpg";
	$nullphoto = "photos/null.jpg";

	require 'mysql/connect.php';
	$result = $con->prepare("UPDATE employee SET eid='$eid',e_rank='$rank',e_firstname='$firstname',e_lastname='$lastname',e_idarmy='$idarmy',e_corps='$corps',e_origin='$origin',birthday='$birthday',e_pid='$position',e_salary='$salary' WHERE eid='$oid'");
	$delpid = $con->prepare("UPDATE db_position SET p_eid=null WHERE pid='$opid'");
	$addpid = $con->prepare("UPDATE db_position SET p_eid='$eid' WHERE pid='$position'");

	if ($result->execute()) {
		$v1 = 1;
		if ($delpid->execute()) {
			$addpid->execute();
		} else {
			$v1 = 0;
		}
		if ($newphoto != $oldphoto) {
			rename($oldphoto, $newphoto);
		}
		if ($_FILES['ephoto']['error'] == 0) {
			move_uploaded_file($_FILES['ephoto']['tmp_name'], $newphoto);
		}
	} else {
		$v1 = 0;
	}
	require("mysql/uncon.php");
	?>
	<script language="javascript">
		var v1 = <?php echo $v1; ?>;
		if (v1 == 1) {
			alert("แก้ไขข้อมูลเรียบร้อย");
			window.location.replace("profile.php?eid=<?php echo ($eid); ?>");
		} else {
			alert("แก้ไขข้อมูลล้มเหลว กรุณาทำรายการใหม่");
			window.history.back();
		}
	</script>
</body>

</html>