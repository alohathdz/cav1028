<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cavalry 28th</title>
</head>

<body>
	<?php
	$rank = $_POST['rank'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$birthday = $_POST['birthday'];
	$eid = $_POST['eid'];
	$idarmy = $_POST['idarmy'];
	$salary = $_POST['salary'];
	$corps = $_POST['corps'];
	$origin = $_POST['origin'];
	$position = $_POST['position'];
	$level = "user";
	$photo = "photos/" . $eid . ".jpg";
	$nullphoto = "photos/null.jpg";

	require("mysql/connect.php");
	$result = $con->prepare("INSERT INTO employee(e_rank,e_firstname,e_lastname,birthday,eid,e_idarmy,e_salary,e_corps,e_origin,e_pid,e_level) VALUES ('$rank','$firstname','$lastname','$birthday','$eid','$idarmy','$salary','$corps','$origin','$position','$level')");
	$sql = $con->prepare("UPDATE position SET p_eid='$eid' WHERE pid='$position'");
	if ($result->execute()) {
		$v1 = 1;
		$sql->execute();
		if (!move_uploaded_file($_FILES['ephoto']['tmp_name'], $photo)) {
			copy($nullphoto, $photo);
		}
	} else {
		$v1 = 0;
	}

	require("mysql/uncon.php");
	?>

	<script language="javascript">
		var v1 = <?php echo ($v1); ?>;
		if (v1 == 1) {
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.replace("profile.php?eid=<?php echo ($eid); ?>");
		} else {
			alert("บันทึกข้อมูลล้มเหลว กรุณาทำรายการใหม่");
			window.history.back();
		}
	</script>

</body>

</html>