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
<title>Bootstrap 4 Dropdowns within a Navbar</title>

<link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css">

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fix-top navbar-dark bg-dark">
<img src="photos/logo.png" width="30" height="30" alt="">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">หน้าหลัก <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ทำเนียบกองพัน</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img src="photos/1670200172231.jpg" class="rounded-circle" width="30" height="30" alt="">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">ยินดีต้อนรับ</h1>
    <p class="lead">คุณ วรดร บุญเขต</p>
  </div>
</div>

<script src="node_modules\jquery\dist\jquery.min.js"></script>
<script src="node_modules\popper.js\dist\popper.min.js"></script>
<script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>


</body>
</html>
<?php } ?>