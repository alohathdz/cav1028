<?php require("mysql/config.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
<title>Cavalry Management System</title>
</head>

<body>
	<?php
	$eid=$_POST['eid']; /* id กำลังพล */
	$rank=$_POST['rank']; // ยศ
	$firstname=$_POST['firstname']; /* ชื่อ */
	$lastname=$_POST['lastname']; /* สกุล */
	$idarmy=$_POST['idarmy']; /* เลข 10 หลัก ทหาร */
	$pid=$_POST['pid']; /* เลขตำแหน่ง */
	$salary=$_POST['salary']; // เงินเดือน
	$photo="photos/".$eid.".jpg";
	$nullphoto="photos/null.jpg";
	
	$sql="INSERT INTO employee(eid,e_rank,e_firstname,e_lastname,e_idarmy,e_pid,e_salary) VALUES ('$eid','$rank','$firstname','$lastname','$idarmy','$pid','$salary')";
	require("mysql/connect.php");
//	$result=$con->prepare($sql);
	//$result->execute();
	
//	if ($result==true) {
	if ($result=$con->query($sql)){
		$v1=1;
		if (!move_uploaded_file($_FILES['ephoto']['tmp_name'],$photo)){
			copy($nullphoto,$photo);
		}
	} else {
		$v1=0;
	}
	require("mysql/uncon.php");
	?>
	<script language="javascript">
	var v1 = <?php echo($v1);?>;
		if (v1==1) {
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.replace("profile.php?eid=<?php echo($eid);?>");
		} else {
			alert("บันทึกข้อมูลล้มเหลว กรุณาทำรายการใหม่");
			window.history.back();
		}
	</script>
</body>
</html>