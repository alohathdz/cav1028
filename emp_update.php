<?php require("mysql/config.php");?>
<html>
<head>
<meta charset="utf-8">
<title>Cavalry Management System</title>
</head>

<body>
	<?php
	$oid=$_POST['oid']; /* เลขบัตรประชาชน เก่า */
	$eid=$_POST['eid']; /* เลขบัตรประชาชน */
	$rank=$_POST['rank']; // ยศ
	$firstname=$_POST['firstname']; /* ชื่อ */
	$lastname=$_POST['lastname']; /* สกุล */
	$idarmy=$_POST['idarmy']; /* เลข 10 หลัก ทหาร */
	$pid=$_POST['pid']; // เลขตำแหน่ง
	$salary=$_POST['salary']; // เงินเดือน
	$oldphoto="photos/".$oid.".jpg";
	$newphoto="photos/".$eid.".jpg";
	$nullphoto="photos/null.jpg";
	
	$sql="UPDATE employee SET eid='$eid',e_rank='$rank',e_firstname='$firstname',e_lastname='$lastname',e_idarmy='$idarmy',e_pid='$pid',e_salary='$salary' WHERE eid='$oid'";
	require("mysql/connect.php");
	//$result=$con->prepare($sql);
	//$result->execute();
	
	if ($result=$con->query($sql)) {
		$v1=1;
		if ($newphoto!=$oldphoto) {
			rename($oldphoto,$newphoto);
		}
		if ($_FILES['ephoto']['error']==0) {
			move_uploaded_file($_FILES['ephoto']['tmp_name'],$newphoto);
		}
	} else {
		$v1=0;
	}
	require("mysql/uncon.php");
	?>
	<script language="javascript">
	var v1 = <?php echo $v1; ?>;
		if (v1==1) {
			alert("แก้ไขข้อมูลเรียบร้อย");
			window.location.replace("emp_detail.php?eid=<?php echo($eid);?>");
		} else {
			alert("แก้ไขข้อมูลล้มเหลว กรุณาทำรายการใหม่");
			window.history.back();
		}
	</script>
</body>
</html>