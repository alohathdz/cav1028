<?php
session_start();
if (!$_SESSION["UserLevel"]) {
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
          <li class="nav-item active">
            <a class="nav-link" href="list.php">รายชื่อกำลังพล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ทำเนียบกองพัน</a>
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
              <img src="<?php echo $_SESSION["Photo"]; ?>" class="rounded-circle" width="30" height="30" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="emp_detail.php?eid=<?php echo $_SESSION["UserID"]; ?>">ข้อมูลส่วนตัว</a>
              <a class="dropdown-item" href="#">เปลี่ยนรหัสผ่าน</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <?php
                                                                require 'mysql/connect.php';
                                                                $result = $con->prepare("SELECT em.*,db_po.p_aname,ra.r_aname,salary.s_name FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) LEFT JOIN salary ON(em.e_salary = salary.s_name) ORDER BY em.e_rank ASC");
                                                                $result->execute();
    ?>

    <!-- Table -->
    <br><br>
    <div class="container">
      <h1 class="text-center">รายชื่อกำลังพล</h1><br>
      <table class="table table-bordered" id="edit_table">
        <thead>
          <tr class="text-center">
            <th>ลำดับ</th>
            <th>ยศ</th>
            <th>ชื่อ</th>
            <th>สกุล</th>
            <th>หมายเลขประจำตัวประชาชน</th>
            <th>หมายเลขข้าราชการ</th>
            <th>Menu</th>
          </tr>
        </thead>
        <tbody>
          <?php
                                                                require 'function.php';
                                                                $i = 0;
                                                                while ($record = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                  $i++;
                                                                  echo '<tr>
                <td class="text-center">' . $i . '</td>
                <td class="text-center">' . $record['r_aname'] . '</td>
                <td>' . $record['e_firstname'] . '</td>
                <td>' . $record['e_lastname'] . '</td>
                <td class="text-center">' . FnID($record['eid']) . '</td>
                <td class="text-center">' . $record['e_idarmy'] . '</td>
                <td class="text-center">
                <a href="profile.php?eid=' . $record['eid'] . '" class="btn btn-primary btn-sm">View</a>';

                if ($_SESSION["UserLevel"]=="admin") {
                echo '
                <a href="edit.php?eid=' . $record['eid'] . '" class="btn btn-secondary btn-sm">Edit</a>
                <a href="javascript:removedata(' . $record['eid'] . ')" class="btn btn-danger btn-sm">Delete</a>  
                </td>';
              }

                echo '</tr>';
                                                                } ?>
        </tbody>
      </table>
    </div>

    <!-- Node JS -->
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

    <!-- Script Delete -->
    <script language="javascript">
      function removedata(eid) {
        if (confirm("ยืนยันการลบข้อมูล") == true) {
          window.location.href = "emp_delete.php?eid=" + eid;
        }
      }
    </script>

  </body>

  </html>
<?php } ?>