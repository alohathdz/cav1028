<?php require('mysql/config.php'); ?>
<html>

<head>
	<meta charset="utf-8">
	<title>Cav28 List</title>
	<!-- Custom fonts for this template-->
	<link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- เรียกใช้ Sidebar Topbar -->
	<?php require('bootstrap/autoload_start.php'); ?>

	<?php
	$sql = "SELECT em.*,db_po.p_fname,ra.r_aname FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) ORDER BY e_rank ASC";
	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
		$sql .= "WHERE eid='$keyword' OR e_firstname LIKE '%$keyword%'";
	} else {
		$keyword = "";
	}
	require('mysql/connect.php');
	$result = $con->prepare($sql);
	$result->execute();
	?>
	<form action="emp_list.php" method="get" name="SearchForm" target="_self" id="SearchForm">
		<label for="keyword">ค้นหา : </label>
		<input name="keyword" type="text" id="keyword" value="<?php echo ($keyword); ?>">
		<input type="submit" name="submit" id="submit" value="Submit">
		&emsp;
		<a href="emp_list.php">ALL</a>
		&emsp;
		<a href="emp_form.php">ADD</a>
	</form>
	<!-- หัวตาราง -->
	<div class="container">
		<table border="0" cellspacing="0" cellpadding="5">
			<tbody>
				<br><br><br>
				<tr>
					<td align="center" valign="top" bgcolor="#7C7C7C">Manage</td>
					<td align="center" valign="top" bgcolor="#7C7C7C">เลข 13 หลัก</td>
					<td align="center" valign="top" bgcolor="#7C7C7C">ยศ ชื่อ - สกุล</td>
					<td align="center" valign="top" bgcolor="#7C7C7C">ตำแหน่ง</td>
					<td align="center" valign="top" bgcolor="#7C7C7C">เลขที่ตำแหน่ง</td>
				</tr>
				<?php
				while ($record = $result->fetch()) {
					$eid = $record["eid"];
					$rank = $record["r_aname"];
					$firstname = $record["e_firstname"];
					$lastname = $record["e_lastname"];
					$positionName = $record["p_fname"];
					$pid = $record["e_pid"];
					?>
					<tr>
						<td align="left" valign="top">
							<a href="emp_detail.php?eid=<?php echo $eid; ?>">View</a>
							<a href="emp_form.php?eid=<?php echo $eid; ?>">Edit</a>
							<a href="javascript:removedata('<?php echo $eid; ?>')">Remove</a></td>
						<td align="left" valign="top"><?php echo $eid; ?></td>
						<td align="left" valign="top"><?php echo $rank." ".$firstname." ".$lastname; ?></td>
						<td align="left" valign="top"><?php echo $positionName; ?></td>
						<td align="left" valign="top"><?php echo $pid; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<!-- จบการใช้งาน Bar / MySQL -->
	<?php
	require('bootstrap/autoload_end.php');
	require('mysql/uncon.php');
	?>

	<script language="javascript">
		function removedata(eid) {
			if (confirm("ยืนยันการลบข้อมูล") == true) {
				window.location.href = "emp_delete.php?eid=" + eid;
			}
		}
	</script>
	<!-- Bootstrap core JavaScript-->
	<script src="asset/vendor/jquery/jquery.min.js"></script>
	<script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="asset/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="asset/vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="asset/js/demo/chart-area-demo.js"></script>
	<script src="asset/js/demo/chart-pie-demo.js"></script>
</body>

</html>