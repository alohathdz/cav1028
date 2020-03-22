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

<?php include("navbar.php"); ?>

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