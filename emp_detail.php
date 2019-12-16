<?php require("mysql/config.php");?>
<html>
<head>
<meta charset="utf-8">
<title>Cavalry Management System</title>
</head>

<body>
	<?php
	$eid=$_GET['eid'];
  //	require("emp_select.php");
  $ephoto="photos/".$eid.".jpg"; /* รูปภาพ */
  $sql="SELECT em.*,db_po.p_fname,ra.r_aname,sa.s_money FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) left join salary sa ON(em.e_salary = sa.s_name) WHERE eid='$eid'";
  require 'mysql/connect.php';
  $result=$con->prepare($sql);
  $result->execute();
  ?>
<table border="0" cellspacing="0" cellpadding="5">
  <caption>
  ฐานข้อมูลกำลังพล
  </caption>
  <tbody>
    <tr>
      <td colspan="2" align="left" valign="top"><img src="<?php echo($ephoto);?>" width="128" height="128" alt=""/></td>
    </tr>
    <?php
    while($record=$result->fetch()){
      $eid=$record['eid'];
      $rank=$record['r_aname'];
      $firstname=$record['e_firstname'];
      $lastname=$record['e_lastname'];
      $idarmy=$record['e_idarmy'];
      $postion=$record['p_fname'];
      $pid=$record['e_pid'];
      $salary=$record['s_money'];
    }
    ?>
    <tr>
      <td align="right" valign="top">เลขบัตรประชาชน :</td>
      <td align="left" valign="top"><?php echo($eid);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">ยศ :</td>
      <td align="left" valign="top"><?php echo($rank);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">ชื่อ :</td>
      <td align="left" valign="top"><?php echo($firstname);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">สกุล :</td>
      <td align="left" valign="top"><?php echo($lastname);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">เลขประจำตัว 10 หลัก :</td>
      <td align="left" valign="top"><?php echo($idarmy);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">เลขที่ตำแหน่ง :</td>
      <td align="left" valign="top"><?php echo($pid);?></td>
    </tr>
    <tr>
      <td align="right" valign="top">ตำแหน่ง :</td>
      <td align="left" valign="top"><?php echo($postion);?></td>
    </tr>
     <tr>
      <td align="right" valign="top">เงินเดือน :</td>
      <td align="left" valign="top"><?php echo($salary);?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><a href="emp_form.php?eid=<?php echo($eid);?>">Edit</a> <a href="javascript:removedata();">Remove</a></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><a href="javascript:window.history.back();">Back</a> <a href="index.php">Home</a></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
	<script language="javascript">
	function removedata(){
		if(confirm("ยืนยันการลบข้อมูล")==true) {
			window.location.href="emp_delete.php?eid=<?php echo($eid);?>";
		}
	}
	</script>
</body>
</html>