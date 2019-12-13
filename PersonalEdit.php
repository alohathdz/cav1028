<?php session_start(); ?>
<?php
require('mysql/config.php');
if (!$_SESSION["UserID"]) {
  header("location: login.php");
} else {
  if ($_SESSION["UserLevel"] != "admin") {
    header("location: index.php");
  } else {
    ?>
    <!DOCTYPE html>

    <html>

    <head>
      <meta charset="utf-8">
      <title>กองพันทหารม้าที่ 28 กองพลทหารม้าที่ 1</title>
      <script src="asset/vendor/jquery/jquery.min.js"></script>
      <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="jquery.tabledit.js"></script>
    </head>

    <body>
      <br />
      <!-- Navbar -->
      <nav class="navbar fixed-top navbar-light bg-light">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" href="#">รายชื่อกำลังพล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ทำเนียบหน่วย</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </nav>
      <hr /><br />
      <?php
          $sql = "SELECT * FROM employee LEFT JOIN rank ON(e_rank = rid) ORDER BY e_rank ASC";
          require('mysql/connect.php');
          $result = $con->prepare($sql);
          $result->execute();
          ?>
      <div class="container">
        <h2 align="center">ฐานข้อมูลกำลังพล</h2><br>
        <table id="edit_table" class="table table-bordered">
          <thead>
            <tr>
              <th width="10%">ยศ</th>
              <th width="40%">ชื่อ</th>
              <th width="40%">สกุล</th>
              <th width="20%">เลขประจำตัวประชาชน</th>
            </tr>
          </thead>
          <tbody>
            <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>
                              <td>' . $row['r_aname'] . '</td>
                              <td>' . $row['e_firstname'] . '</td>
                              <td>' . $row['e_lastname'] . '</td>
                              <td>' . $row['eid'] . '</td>
                          </tr>';
                }
                ?>
          </tbody>
        </table>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $('#edit_table').Tabledit({
            url: 'action.php',
            columns: {
              identifier: [3, "eid"],
              editable: [
                [1, 'e_firstname'],
                [2, 'e_lastname']
              ]
            },
            onSuccess: function(data, textStatus, jqXHR) {
              if (data.action == 'delete') {
                $('#' + data.eid).remove();
              }
            }
          });
        });
      </script>
    </body>

    </html>
<?php
  }
}
?>