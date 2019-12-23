<?php
session_start();
if (!$_SESSION["UserLevel"]) {
  header("location: login.php");
} else {
  if (isset($_SESSION["timeout"]) && (time() - $_SESSION["timeout"] > 1800)) {
    session_destroy();   // ทำลาย session
  }
  $_SESSION["timeout"] = time();
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

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">ยินดีต้อนรับ</h1>
        <p class="lead"><?php echo $_SESSION["User"]; ?></p>
      </div>
    </div>

    <!-- Card -->
    <div class="container">
      <form class="form-row">
        <a href="list.php" class="card text-white bg-primary mx-auto mb-3" style="max-width: 18rem;">
          <div class="card-header">Personal</div>
          <div class="card-body">
            <h5 class="card-title">รายชื่อกำลังพล</h5>
            <p class="card-text">กองพันทหารม้าที่ 28 กองพลทหารม้าที่ 1</p>
          </div>
        </a>
        <a href="department.php" class="card text-white bg-secondary mx-auto mb-3" style="max-width: 18rem;">
          <div class="card-header">Department</div>
          <div class="card-body">
            <h5 class="card-title">ทำเนียบหน่วย</h5>
            <p class="card-text">กองพันทหารม้าที่ 28 กองพลทหารม้าที่ 1</p>
          </div>
        </a>
        <a href="personaladd.php" class="card text-white bg-success mx-auto mb-3" style="max-width: 18rem;">
          <div class="card-header">Add Personal</div>
          <div class="card-body">
            <h5 class="card-title">เพิ่มข้อมูลกำลังพล</h5>
            <p class="card-text">กองพันทหารม้าที่ 28 กองพลทหารม้าที่ 1</p>
          </div>
        </a>
      </form>
    </div>

    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>


  </body>

  </html>
<?php } ?>