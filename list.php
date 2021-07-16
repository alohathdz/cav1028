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

  <?php include("navbar.php"); ?>

    <!-- เชื่อมฐานข้อมูล -->
    <?php
                                                                require 'mysql/connect.php';
                                                                $result = $con->prepare("SELECT em.*,db_po.p_aname,ra.r_aname,salary.s_name FROM employee em left join position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) LEFT JOIN salary ON(em.e_salary = salary.s_name) ORDER BY em.e_rank ASC");
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
                                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                  $i++;
                                                                  echo '<tr>
                <td class="text-center">' . $i . '</td>
                <td class="text-center">' . $row['r_aname'] . '</td>
                <td>' . $row['e_firstname'] . '</td>
                <td>' . $row['e_lastname'] . '</td>
                <td class="text-center">' . FnID($row['eid']) . '</td>
                <td class="text-center">' . $row['e_idarmy'] . '</td>
                <td class="text-center">
                <a href="profile.php?eid=' . $row['eid'] . '" class="btn btn-primary btn-sm">View</a>';

                if ($_SESSION["UserLevel"]=="admin") {
                echo '
                <a href="edit.php?eid=' . $row['eid'] . '" class="btn btn-secondary btn-sm">Edit</a>
                <a href="javascript:removedata(' . $row['eid'] . ')" class="btn btn-danger btn-sm">Delete</a>  
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