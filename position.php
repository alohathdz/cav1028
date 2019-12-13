<?php
require('mysql/config.php');
require 'function.php';
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>ทำเนียบ ม.พัน.28 พล.ม.1</title>

  <!-- Custom fonts for this template -->
  <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Start Sidebar Topbar -->
  <?php include('bootstrap/autoload_start.php'); ?>

  <!-- เชื่อมต่อฐานข้อมูล -->
  <?php
  $sql = "SELECT * FROM db_position left join employee ON(db_position.p_eid = employee.eid) left join rank ON(employee.e_rank = rank.rid) ORDER BY db_position.pid ASC";
  require('mysql/connect.php');
  $result = $con->prepare($sql);
  $result->execute();
  ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ทำเนียบ กองพันทหารม้าที่ 28 กองพลทหารม้าที่ 1</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">ลำดับ</th>
                <th class="text-center">ตำแหน่ง</th>
                <th class="text-center">ชกท.</th>
                <th class="text-center">อัตรา</th>
                <th class="text-center">เหล่า</th>
                <th class="text-center">ยศ ชื่อ นามสกุล<br>หมายเลขบัตรประชาชน</th>
                <th class="text-center">เพิ่ม/ลบ</th>
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
                  <td bgcolor="#e0e0eb" align="center">' . $i . '</td>
                  <td bgcolor="#e0e0eb" width="35%">' . $record['p_aname'] . "<br>( " . $record['p_fname'] . " )<br>" . $record['pid'] . '</td>
                  <td bgcolor="#e0e0eb" align="center">' . $record['p_expert'] . '</td>
                  <td bgcolor="#e0e0eb" align="center">' . $record['p_rate'] . '</td>
                  <td bgcolor="#e0e0eb" align="center">' . $record['p_corps'] . '</td>
                  <td bgcolor="#e0e0eb" align="center">' . $record['r_aname'] . " " . $record['e_firstname'] . " " . $record['e_lastname'] . "<br>" . $record['e_idarmy'] . "<br>" . FnID($record['p_eid']) . '</td>
                  <td bgcolor="#e0e0eb" align="center">เพิ่ม / ลบ</td>
                </tr>';
                } else {
                  echo '<tr>
                  <td align="center">' . $i . '</td>
                  <td width="35%">' . $record['p_aname'] . "<br>( " . $record['p_fname'] . " )<br>" . $record['pid'] . '</td>
                  <td align="center">' . $record['p_expert'] . '</td>
                  <td align="center">' . $record['p_rate'] . '</td>
                  <td align="center">' . $record['p_corps'] . '</td>
                  <td align="center">' . $record['r_aname'] . " " . $record['e_firstname'] . " " . $record['e_lastname'] . "<br>" . $record['e_idarmy'] . "<br>" . FnID($record['p_eid']) . '</td>
                  <td align="center">เพิ่ม / ลบ</td>
                </tr>';
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

    <!-- End Sidebar Topbar -->
    <?php include('bootstrap/autoload_end.php'); ?>

    <!-- ออกจากฐานข้อมูล -->
    <?php require('mysql/uncon.php'); ?>

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