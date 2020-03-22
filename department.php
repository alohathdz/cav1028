<?php
session_start();
if ($_SESSION["UserLevel"] != "admin") {
  header("location: login.php");
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cavalry 28th</title>

    <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css">

  </head>

  <body>

  <?php include("navbar.php"); ?>

    <!-- เชื่อมต่อฐานข้อมูล -->
    <?php
    require('mysql/connect.php');
    require 'function.php';
    $result = $con->prepare("SELECT * FROM db_position left join employee ON(db_position.p_eid = employee.eid) left join rank ON(employee.e_rank = rank.rid) ORDER BY db_position.pid ASC");
    $result->execute();
    ?>

    <!-- Table ตำแหน่ง -->
    <br><br>
    <div class="container">
      <h1 class="text-center">ทำเนียบกองพัน</h1><br>
      <table class="table table-bordered" id="edit_table">
        <thead>
          <tr class="text-center">
            <th>ลำดับ</th>
            <th>ตำแหน่ง</th>
            <th>ชกท.</th>
            <th>อัตรา</th>
            <th>เหล่า</th>
            <th>ยศ ชื่อ นามสกุล<br>หมายเลขบัตรประชาชน</th>
            <th>เพิ่ม/ลบ</th>
          </tr>
        </thead>
        <tbody>

          <!-- วน loop ตำแหน่ง -->
          <?php
          $i = 0;
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $i++;
            if ($row['p_status'] == "ปิด") {
              echo '<tr>
<td bgcolor="#e0e0eb" class="text-center">' . $i . '</td>
<td bgcolor="#e0e0eb" width="35%">' . $row['p_aname'] . "<br>( " . $row['p_fname'] . " )<br>" . $row['pid'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $row['p_expert'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $row['p_rate'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $row['p_corps'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $row['r_aname'] . " " . $row['e_firstname'] . " " . $row['e_lastname'] . "<br>" . $row['e_idarmy'] . "<br>" . FnID($row['p_eid']) . '</td>
<td bgcolor="#e0e0eb" class="text-center">เพิ่ม / ลบ</td>
</tr>';
            } else {
              echo '<tr>
<td class="text-center">' . $i . '</td>
<td width="35%">' . $row['p_aname'] . "<br>( " . $row['p_fname'] . " )<br>" . $row['pid'] . '</td>
<td class="text-center">' . $row['p_expert'] . '</td>
<td class="text-center">' . $row['p_rate'] . '</td>
<td class="text-center">' . $row['p_corps'] . '</td>
<td class="text-center">' . $row['r_aname'] . " " . $row['e_firstname'] . " " . $row['e_lastname'] . "<br>" . $row['e_idarmy'] . "<br>" . FnID($row['p_eid']) . '</td>
<td class="text-center">
<a href="#" class="btn btn-primary btn-sm">เพิ่ม</a>
<a href="#" class="btn btn-danger btn-sm">ลบ</a>
</td>
</tr>';
            }
          } ?>
        </tbody>
      </table>
    </div>


    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>


  </body>

  </html>
<?php } ?>