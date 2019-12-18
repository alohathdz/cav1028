<?php require("mysql/config.php"); ?>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Cavalry Management System</title>
</head>

<body>
	<?php
	if (isset($_GET['eid'])) {
		$eid = $_GET['eid'];
		require("emp_select.php");
		$action = "emp_update.php";
	} else {
		$eid = ""; /* เลขบัตรประชาชน */
		$rank = ""; // ยศ
		$firstname = ""; /* ชื่อ */
		$lastname = ""; /* สกุล */
		$idarmy = ""; /* เลข 10 หลัก ทหาร */
		$pid = ""; /* เลขตำแหน่ง */
		$salary = ""; // เงินเดือน
		$ephoto = "photos/null.jpg";
		$action = "emp_insert.php";
	}
	require('mysql/connect.php');
	?>
	<form action="<?php echo ($action); ?>" method="post" enctype="multipart/form-data" target="_self" onSubmit="return checkForm();">
		<!-- หัวตาราง -->
		<table border="0" cellspacing="0" cellpadding="5">
			<caption>
				เพิ่มข้อมูลกำลังพล กองพันทหารม้าที่ 28
			</caption>
			<tbody>
				<tr>
					<div class="form-group">
						<td colspan="2" align="left" valign="top"><img src="<?php echo ($ephoto); ?>" width="128" height="128"><br>
							<input name="oid" type="hidden" id="oid" value="<?php echo ($eid); ?>">
							<input type="file" name="ephoto" id="ephoto"></td>
					</div>
				</tr>
				<!-- เลขบัตรประชาชน -->
				<tr>
					<td align="right" valign="top">เลขบัตรประชาชน :</td>
					<td align="left" valign="top">
						<input name="eid" type="text" id="eid" value="<?php echo ($eid); ?>" maxlength="13"></td>
				</tr>
				<!-- ยศ -->
				<tr>
					<td align="right" valign="top">ยศ :</td>
					<td align="left" valign="top">
						<select name="rank" id="rank">
							<option value="">โปรดเลือกยศ</option>
							<?php
																			$rnk = $con->prepare("SELECT * FROM rank ORDER BY rid ASC");
																			$rnk->execute();
																			while ($rsRank = $rnk->fetch()) {
							?>
								<option value="<?php echo ($rsRank['rid']); ?>" <?php if ($rank == $rsRank['rid']) {
																					echo "selected";
																				} ?>>
									<?php echo ($rsRank['r_aname']); ?></option>
							<?php
																			}
							?>
						</select></td>
				</tr>
				<!-- ชื่อ -->
				<tr>
					<td align="right" valign="top">ชื่อ :</td>
					<td align="left" valign="top"><input name="firstname" type="text" id="firstname" value="<?php echo ($firstname); ?>"></td>
				</tr>
				<!-- สกุล -->
				<tr>
					<td align="right" valign="top">สกุล :</td>
					<td align="left" valign="top"><input name="lastname" type="text" id="lastname" value="<?php echo ($lastname); ?>"></td>
				</tr>
				<tr>
					<td align="right" valign="top">หมายเลขประจำตัว 10 หลัก :</td>
					<td align="left" valign="top"><input name="idarmy" type="text" id="idarmy" value="<?php echo ($idarmy); ?>" maxlength="10"></td>
				</tr>
				<tr>
					<td align="right" valign="top">ตำแหน่ง :</td>
					<td align="left" valign="top">
						<select name="pid" id="pid">
							<option value="null">โปรดเลือกตำแหน่งของท่าน</option>
							<?php
																											$pst = $con->prepare("SELECT * FROM db_position ORDER BY pid ASC");
																											$pst->execute();
																											while ($rsPst = $pst->fetch()) {
							?>
								<option value="<?php echo ($rsPst['pid']); ?>" <?php if ($pid == $rsPst['pid']) {
																													echo "selected";
																												} ?>>
									<?php echo ($rsPst['pid']) . " - " . ($rsPst['p_fname']); ?></option>
							<?php
																											}
							?>
						</select></td>
				</tr>
				<tr>
					<td align="right" valign="top">เงินเดือน :</td>
					<td align="left" valign="top">
						<select name="salary" id="salary">
							<option value="null">โปรดเลือกเงินเดือนของท่าน</option>
							<?php
																											$sal = $con->prepare("SELECT * FROM salary ORDER BY sid ASC");
																											$sal->execute();
																											while ($rsSal = $sal->fetch()) {
							?>
								<option value="<?php echo ($rsSal['s_name']); ?>" <?php if ($salary == $rsSal['s_name']) {
																													echo "selected";
																												} ?>>
									<?php echo ($rsSal['s_name']) . " - " . ($rsSal['s_money']); ?></option>
							<?php
																											}
							?>
						</select></td>
				</tr>
				<tr>
					<td colspan="2" align="right" valign="top">
						<input type="submit" name="submit" id="submit" value="Submit">
						&nbsp;
						<input type="reset" name="Reset" id="Reset" value="Reset"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="top">
						<a href="javascript:window.history.back();">Back</a>
						<a href="emp_list.php">Home</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<?php require('mysql/uncon.php'); ?>
	<script language="javascript">
		function checkForm() {
			var v1 = document.getElementById('eid').value;
			if (v1.length < 1) {
				alert("กรอก เลขบัตรประชาชน :");
				document.getElementById('eid').focus();
				return false;
			} else {
				return true;
			}
		}
	</script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>