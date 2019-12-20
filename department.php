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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <img src="photos/logo.png" width="30" height="30" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">หน้าหลัก <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list.php">รายชื่อกำลังพล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">ทำเนียบกองพัน</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="PersonalADD.php">เพิ่มข้อมูลกำลังพล</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="http://localhost/phpmyadmin/">MySQL</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $_SESSION['Photo']; ?>" class="rounded-circle" width="30" height="30" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile.php?eid=<?php echo $_SESSION["UserID"]; ?>">ข้อมูลส่วนตัว</a>
              <a class="dropdown-item" href="#">เปลี่ยนรหัสผ่าน</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

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
          while ($record = $result->fetch(PDO::FETCH_ASSOC)) {
            $i++;
            if ($record['p_status'] == "ปิด") {
              echo '<tr>
<td bgcolor="#e0e0eb" class="text-center">' . $i . '</td>
<td bgcolor="#e0e0eb" width="35%">' . $record['p_aname'] . "<br>( " . $record['p_fname'] . " )<br>" . $record['pid'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $record['p_expert'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $record['p_rate'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $record['p_corps'] . '</td>
<td bgcolor="#e0e0eb" class="text-center">' . $record['r_aname'] . " " . $record['e_firstname'] . " " . $record['e_lastname'] . "<br>" . $record['e_idarmy'] . "<br>" . FnID($record['p_eid']) . '</td>
<td bgcolor="#e0e0eb" class="text-center">เพิ่ม / ลบ</td>
</tr>';
            } else {
              echo '<tr>
<td class="text-center">' . $i . '</td>
<td width="35%">' . $record['p_aname'] . "<br>( " . $record['p_fname'] . " )<br>" . $record['pid'] . '</td>
<td class="text-center">' . $record['p_expert'] . '</td>
<td class="text-center">' . $record['p_rate'] . '</td>
<td class="text-center">' . $record['p_corps'] . '</td>
<td class="text-center">' . $record['r_aname'] . " " . $record['e_firstname'] . " " . $record['e_lastname'] . "<br>" . $record['e_idarmy'] . "<br>" . FnID($record['p_eid']) . '</td>
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