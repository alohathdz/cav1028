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
      <div class="card text-center">
        <div class="card-body">
          <img src="<?php echo $ephoto; ?>" class="img-thumbnail" width="200" height="200" alt="">
          <br><br>
          <form>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="fullname">ยศ ชื่อ - สกุล</label>
                <input type="text" class="form-control text-center" id="fullname" placeholder="<?php echo $rank . " " . $firstname . " " . $lastname; ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="eid">หมายเลขประจำตัวประชาชน</label>
                <input type="text" class="form-control text-center" id="eid" placeholder="<?php echo $eid; ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="idarmy">หมายเลขข้าราชการ</label>
                <input type="text" class="form-control text-center" id="idarmy" placeholder="<?php echo $idarmy; ?>">
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
                <input type="text" class="form-control text-center" id="birthday" placeholder="<?php echo $birthday; ?>">
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
              <div class="form-group col-md-10">
                <label for="position">ตำแหน่ง</label>
                <select id="positon" name="position" class="form-control">
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
                </select>              </div>
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
<?php }
} ?>