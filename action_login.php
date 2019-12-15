<?php
session_start();
if(isset($_POST['Username'])) {
    // เชื่อมต่อ MySQL
    include 'mysql/connection.php';
    // รับค่า user pass
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    // Query
    $sql = "SELECT * FROM employee WHERE eid = '$Username' AND e_idarmy = '$Password'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION["UserID"] = $row["eid"];
        $_SESSION["User"] = $row["e_firstname"]." ".$row["e_lastname"];
        $_SESSION["UserLevel"] = $row["e_level"];
        $_SESSION["Photo"] = "photos/".$row["eid"].".jpg";

        // เช็ค Admin
        if($_SESSION["UserLevel"]=="admin") {
            header("location: 1.php");
        }
        if($_SESSION["UserLevel"]=="user") {
            header("location: PersonalList.php");
        }
    } else {
        echo "<script>alert('User หรือ Password ไม่ถูกต้อง');</script>";
    }
} else {
    header("location: login.php");
}
?>