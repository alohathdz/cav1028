<?php session_start(); ?>
<?php
require('mysql/config.php');
require('function.php');
if (!$_SESSION["UserID"]) {
  header("location: login.php");
} else {
  ?>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CAV28 Personal List</title>

    <!-- Custom fonts for this template -->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- เรียกใช้ Sidebar Topbar -->
    <?php require('bootstrap/autoload_start.php'); ?>

    <!-- เชื่อต่อฐานข้อมูล -->
    <?php
      $sql = "SELECT em.*,db_po.p_fname,ra.r_aname FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) ORDER BY em.e_rank ASC";
      require('mysql/connect.php');
      $result = $con->prepare($sql);
      $result->execute();
      ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">รายชื่อกำลังพล ม.พัน.28 พล.ม.1</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">ลำดับ</th>
                  <th class="text-center">ยศ ชื่อ - สกุล</th>
                  <th class="text-center">หมายเลขประจำตัวประชาชน</th>
                  <th class="text-center">หมายเลขข้าราชการ</th>
                  <th class="text-center">เหล่า</th>
                  <th class="text-center">กำเนิด</th>
                  <th class="text-center">ตำแหน่ง</th>
                  <th class="text-center">เงินเดือน</th>
                </tr>
              </thead>

              <!-- วน loop รายชื่อ -->
              <tbody>
                <?php
                  $i = 0;
                  while ($record = $result->fetch()) {
                    $i++;
                    echo '<tr>
                <td align="center">' . $i . '</td>
                <td>' . $record['r_aname'] . " " . $record['e_firstname'] . " " . $record['e_lastname'] . '</td>
                <td align="center" width="16%">' . fnID($record['eid']) . '</td>
                <td align="center">' . $record['e_idarmy'] . '</td>
                <td align="center">' . $record['e_corps'] . '</td>
                <td align="center">' . $record['e_origin'] . '</td>
                <td align="center">' . $record['p_fname'] . '</td>
                <td align="center">' . $record['e_salary'] . '</td>
                </tr>';
                  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- จบการใช้งาน Bar / MySQL -->
      <?php
        require('bootstrap/autoload_end.php');
        require('mysql/uncon.php');
        ?>

      <!-- Javascript แจ้งเตือน -->
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
      <script src="asset/vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

      <!-- Page level custom scripts -->
      <script src="asset/js/demo/datatables-demo.js"></script>

  </body>

  </html>
<?php } ?>