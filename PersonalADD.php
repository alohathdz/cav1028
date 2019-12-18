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
              <img src="<?php echo $_SESSION["Photo"]; ?>" class="rounded-circle" width="30" height="30" alt="">
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
    <br>

    <!-- Form Add Personal -->
    <?php require 'mysql/connect.php'; ?>
    <div class="container">
      <h1 class="text-center">เพิ่มข้อมูลกำลังพล</h1><br>
      <form action="action_insert.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="rank">ยศ</label>
            <select id="rank" name="rank" class="form-control">
              <option selected>เลือกยศ</option>
              <!-- ดึงข้อมูลตำแหน่ง -->
              <?php
                                                              $result = $con->prepare("SELECT * FROM rank ORDER BY rid ASC");
                                                              $result->execute();

                                                              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=" . $row['rid'] . ">" . $row['r_aname'] . "</option>";
                                                              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="firstname">ชื่อ</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="form-group col-md-4">
            <label for="lastname">นามสกุล</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="form-group col-md-2">
            <label for="birthday">วันเกิด</label>
            <input type="date" class="form-control" id="birthday" name="birthday">
          </div>
          <div class="form-group col-md-4">
            <label for="eid">หมายเลขประจำตัวประชาชน</label>
            <input type="number" class="form-control" id="eid" name="eid" required>
          </div>
          <div class="form-group col-md-4">
            <label for="idarmy">หมายเลขข้าราชการ</label>
            <input type="number" class="form-control" id="idarmy" name="idarmy" required>
          </div>
          <div class="form-group col-md-4">
            <label for="salary">เงินเดือน</label>
            <select id="salary" name="salary" class="form-control">
              <option selected>เลือกขั้นเงินเดือน</option>
              <!-- ดึงข้อมูลตำแหน่ง -->
              <?php
                                                              $result = $con->prepare("SELECT * FROM salary ORDER BY sid ASC");
                                                              $result->execute();

                                                              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=" . $row['sid'] . ">" . $row['s_name'] . " " . $row['s_money'] . "</option>";
                                                              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="corps">เหล่า</label>
            <select class="form-control" id="corps" name="corps">
              <option selected>เลือกเหล่า</option>
              <option value="ม.">ม.</option>
              <option value="พ.">พ.</option>
              <option value="กง.">กง.</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="origin">กำเนิด</label>
            <select class="form-control" id="origin" name="origin">
              <option selected>เลือกกำเนิด</option>
              <option value="นร.">นักเรียนนายร้อย</option>
              <option value="นพ.">นักเรียนแพทย์</option>
              <option value="นป.">นายทหารประทวนเลื่อนฐานะ</option>
              <option value="นนส.">นักเรียนนายสิบ</option>
              <option value="นชท.">นักเรียนช่างฝีมือทหาร</option>
              <option value="กองหนุน">กองหนุน</option>
            </select>
          </div>
          <div class="form-group col-md-8">
            <label for="potision">ตำแหน่ง</label>
            <select id="position" name="position" class="form-control">
              <option selected>เลือกตำแหน่ง</option>
              <!-- ดึงข้อมูลตำแหน่ง -->
              <?php
                                                              $result = $con->prepare("SELECT * FROM db_position ORDER BY pid ASC");
                                                              $result->execute();

                                                              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=" . $row['pid'] . ">" . $row['pid'] . " " . $row['p_aname'] . "</option>";
                                                              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-file col-md-3 my-3">
            <input type="file" class="custom-file-input" id="ephoto" name="ephoto">
            <label class="custom-file-label" for="ephoto">เลือกรูปภาพโปรไฟล์</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
        <button type="reset" class="btn btn-danger">Reset</button>
      </form>
    </div>

    <!-- Node_js -->
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\popper.js\dist\popper.min.js"></script>
    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

    <!-- Show File Name -->
    <script>
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
    </script>

  </body>

  </html>

<?php } ?>