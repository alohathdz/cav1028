<?php
session_start();
if (!$_SESSION["UserLevel"]) {
  header("location: login.php");
} else {
  if (empty($_GET['eid'])) {
    header("location: list.php");
  } else {
    $eid = $_GET['eid'];
    require 'action_detail.php';
    require 'function.php';
    $ephoto = "photos/" . $eid . ".jpg"; /* รูปภาพ */
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
              <img src="<?php echo 'photos/'.$_SESSION['UserID'].'.jpg'; ?>" class="rounded-circle" width="30" height="30" alt="">
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

    <!-- Card -->
    <div class="card text-center">
      <div class="card-body">
        <img src="<?php echo "photos/$eid.jpg"; ?>" class="img-thumbnail" width="200" height="200" alt="">
        <br><br>
        <form>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fullname">ยศ ชื่อ - สกุล</label>
              <input type="text" class="form-control text-center" id="fullname" placeholder="<?php echo $rank . " " . $firstname . " " . $lastname; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">หมายเลขประจำตัวประชาชน</label>
              <input type="text" class="form-control text-center" id="eid" placeholder="<?php echo FnID($eid); ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">หมายเลขข้าราชการ</label>
              <input type="text" class="form-control text-center" id="idarmy" placeholder="<?php echo $idarmy; ?>" readonly>
            </div>
            <div class="form-group col-md-1">
              <label for="firstname">เหล่า</label>
              <input type="text" class="form-control text-center" id="corps" placeholder="<?php echo $corps; ?>" readonly>
            </div>
            <div class="form-group col-md-1">
              <label for="firstname">กำเนิด</label>
              <input type="text" class="form-control text-center" id="origin" placeholder="<?php echo $origin; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">วันเกิด</label>
              <input type="text" class="form-control text-center" id="birthday" placeholder="<?php echo $birthday; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">เงินเดือน</label>
              <input type="text" class="form-control text-center" id="salary" placeholder="<?php echo $salary; ?>" readonly>
            </div>
            <div class="form-group col-md-10">
              <label for="firstname">ตำแหน่ง</label>
              <input type="text" class="form-control text-center" id="position" placeholder="<?php echo $position; ?>" readonly>
            </div>
          </div>
          <a href="edit.php?eid=<?php echo $eid; ?>" class="btn btn-primary">Edit</a>
          <a href="javascript:removedata();" class="btn btn-danger">Remove</a>
        </form>
      </div>
    </div>

    <!-- Node JS -->
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

    <!-- remove -->
    <script language="javascript">
      function removedata() {
        if (confirm("ยืนยันการลบข้อมูล") == true) {
          window.location.href = "emp_delete.php?eid=<?php echo ($eid); ?>";
        }
      }
    </script>

  </body>

  </html>
<?php } } ?>