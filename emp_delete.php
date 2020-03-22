<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
<title>Cavalry Management System</title>
</head>

<body>
	<?php
	$eid=$_GET['eid'];
	$photo="photos/".$eid.".jpg";
	
	$sql="DELETE FROM employee WHERE eid='$eid'";
	require("mysql/connect.php");

	if($result=$con->query($sql)) {
		$v1=1;
		unlink($photo);
	} else {
		$v1=0;
	}
	require("mysql/uncon.php");
	?>

	<script language="javascript">
	var v1 = <?php echo $v1; ?>;
		if (v1==1) {
			alert("ลบข้อมูลเรียบร้อย");
			window.location.replace("list.php");
		} else {
			alert("ลบข้อมูลล้มเหลว กรุณาทำรายการใหม่");
			window.history.back();
		}
	</script>
	
</body>
</html>