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
          <li class="nav-item active">
            <a class="nav-link" href="#">หน้าหลัก <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ทำเนียบกองพัน</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="http://localhost/phpmyadmin/">MySQL</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
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

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">ยินดีต้อนรับ</h1>
        <p class="lead"><?php echo $_SESSION["User"]; ?></p>
      </div>
    </div>

    <!-- Card -->
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title"><?php echo $_SESSION["User"]; ?></h5>
        <img src="<?php echo $_SESSION["Photos"]; ?>" class="img-thumbnail" width="200" height="200" alt="">
        <br><br>
        <form>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fullname">ยศ ชื่อ - สกุล</label>
              <input type="text" class="form-control text-center" id="fullname" placeholder="<?php echo $_SESSION["UserRank"]." ".$_SESSION["User"]; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">หมายเลขประจำตัวประชาชน</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserID"]; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">หมายเลขข้าราชการ</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserIDarmy"]; ?>" readonly>
            </div>
            <div class="form-group col-md-1">
              <label for="firstname">เหล่า</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserCorps"]; ?>" readonly>
            </div>
            <div class="form-group col-md-1">
              <label for="firstname">กำเนิด</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserOrigin"]; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">วันเกิด</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserBirthday"]; ?>" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="firstname">เงินเดือน</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserSalary"]; ?>" readonly>
            </div>
            <div class="form-group col-md-10">
              <label for="firstname">ตำแหน่ง</label>
              <input type="text" class="form-control text-center" id="firstname" placeholder="<?php echo $_SESSION["UserPosition"]; ?>" readonly>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">แก้ไข</button>
        </form>
      </div>
    </div>

    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>


  </body>

  </html>
<?php } ?>