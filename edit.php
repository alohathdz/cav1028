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

      <!-- Card -->
      <?php require 'mysql/connect.php' ?>
      <div class="card">
        <div class="card-body text-center">
          <img src="<?php echo $ephoto; ?>" class="img-thumbnail" width="200" height="200" alt="">
          <form action="action_update.php" method="POST" enctype="multipart/form-data" onSubmit="return checkForm();">
            <div class="custom-file col-md-3 my-3">
              <input type="file" class="custom-file-input" id="ephoto" name="ephoto">
              <label class="custom-file-label text-left" for="ephoto">เลือกรูปโปรไฟล์</label>
            </div>
            <input name="oid" type="hidden" id="oid" value="<?php echo $eid; ?>">
            <div class="form-row">
              <div class="form-group col-md-1">
                <label for="rank">ยศ</label>
                <select id="rank" name="rank" class="form-control">
                  <option selected>เลือกยศ</option>
                  <!-- ดึงข้อมูลตำแหน่ง -->
                  <?php
                  $result = $con->prepare("SELECT * FROM rank ORDER BY rid ASC");
                  $result->execute();

                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <option value="<?php echo $row['rid']; ?>" <?php if ($rid == $row['rid']) {
                                                                  echo "selected";
                                                                } ?>>
                      <?php echo ($row['r_aname']); ?>
                    </option>
                  <?php }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="firstname">ชื่อ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname ?>">
              </div>
              <div class="form-group col-md-3">
                <label for="lastname">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="eid">หมายเลขประจำตัวประชาชน</label>
                <input type="text" class="form-control text-center" id="eid" name="eid" value="<?php echo $eid; ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="idarmy">หมายเลขข้าราชการ</label>
                <input type="text" class="form-control text-center" id="idarmy" name="idarmy" value="<?php echo $idarmy; ?>">
              </div>
              <div class="form-group col-md-1">
                <label for="corps">เหล่า</label>
                <select class="form-control" id="corps" name="corps">
                  <option value="ม." <?php if ($corps == "ม.") {
                                        echo "selected";
                                      } ?>>ม.</option>
                  <option value="พ." <?php if ($corps == "พ.") {
                                        echo "selected";
                                      } ?>>พ.</option>
                  <option value="กง." <?php if ($corps == "กง.") {
                                        echo "selected";
                                      } ?>>กง.</option>
                </select>
              </div>
              <div class="form-group col-md-1">
                <label for="origin">กำเนิด</label>
                <select class="form-control" id="origin" name="origin">
                  <option value="นร." <?php if ($origin == "นร.") {
                                        echo "selected";
                                      } ?>>นร.</option>
                  <option value="นพ." <?php if ($origin == "นพ.") {
                                        echo "selected";
                                      } ?>>นพท.</option>
                  <option value="นป." <?php if ($origin == "นป.") {
                                        echo "selected";
                                      } ?>>นป.</option>
                  <option value="นนส." <?php if ($origin == "นนส.") {
                                          echo "selected";
                                        } ?>>นนส.</option>
                  <option value="นชท." <?php if ($origin == "นชท.") {
                                          echo "selected";
                                        } ?>>นชท.</option>
                  <option value="กองหนุน" <?php if ($origin == "กองหนุน") {
                                            echo "selected";
                                          } ?>>กองหนุน</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="birthday">วันเกิด</label>
                <input type="text" class="form-control text-center" id="birthday" name="birthday" value="<?php echo $birthday; ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="salary">เงินเดือน</label>
                <select id="salary" name="salary" class="form-control">
                  <!-- ดึงข้อมูลเงินเดือน -->
                  <?php
                  $result = $con->prepare("SELECT * FROM salary ORDER BY sid ASC");
                  $result->execute();

                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <option value="<?php echo $row['sid']; ?>" <?php if ($sid == $row['sid']) {
                                                                  echo "selected";
                                                                } ?>>
                      <?php echo ($row['s_name']) . " - " . ($row['s_money']); ?>
                    </option>
                  <?php }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-7">
                <label for="position">ตำแหน่ง</label>
                <select id="position" name="position" class="form-control">
                  <!-- ดึงข้อมูลตำแหน่ง -->
                  <?php
                  $result = $con->prepare("SELECT * FROM db_position ORDER BY pid ASC");
                  $result->execute();

                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <option value="<?php echo $row['pid']; ?>" <?php if ($pid == $row['pid']) {
                                                                  echo "selected";
                                                                } ?>>
                      <?php echo ($row['pid']) . " - " . ($row['p_fname']); ?>
                    </option>
                  <?php }
                  ?>
                </select> </div>
            </div>
            <button type="submit" class="btn btn-primary">ยืนยัน</button>
            <button type="reset" class="btn btn-danger">Reset</button>
          </form>
        </div>
      </div>

      <!-- Node JS -->
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

      <!-- remove -->
      <script language="javascript">
        function removedata() {
          if (confirm("ยืนยันการลบข้อมูล") == true) {
            window.location.href = "emp_delete.php?eid=<?php echo ($eid); ?>";
          }
        }
      </script>

      <!-- เช็คเลข 13 หลัก -->
      <script language="javascript">
        function checkForm() {
          var v1 = document.getElementById('eid').value;
          if (v1.length < 1) {
            alert("กรอก เลขบัตรประชาชน :");
            document.getElementById('eid').focus();
            return false;
          } else {
            return true;
          }
        }
      </script>

    </body>

    </html>
<?php }
}
require 'mysql/uncon.php';
?>