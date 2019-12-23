<?php
session_start();
if(isset($_POST['Username'])) {
    // เชื่อมต่อ MySQL
    include 'mysql/connect.php';
    // รับค่า user pass
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    // Query SQL
    $result = $con->prepare("SELECT em.*,db_po.p_fname,ra.r_fname,sa.s_money,sa.s_name FROM employee em left join db_position db_po ON(em.e_pid = db_po.pid) left join rank ra ON(em.e_rank = ra.rid) left join salary sa ON(em.e_salary = sa.sid) WHERE eid='$Username' AND e_idarmy='$Password'");
    $result->execute();
    
    // ดึงข้อมูล SQL
    if ($row=$result->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION["UserID"] = $row["eid"];
        $_SESSION["User"] = $row["e_firstname"]." ".$row["e_lastname"];
        $_SESSION["UserLevel"] = $row["e_level"];
        $_SESSION["UserIDarmy"] = $row["e_idarmy"];
        $_SESSION["UserCorps"] = $row["e_corps"];
        $_SESSION["UserOrigin"] = $row["e_origin"];
        $_SESSION["UserBirthday"] = $row["birthday"];
        $_SESSION["Photo"] = "photos/".$row["eid"].".jpg";
        $_SESSION["UserRank"] = $row["r_fname"];
        $_SESSION["UserPosition"] = $row["p_fname"];
        $_SESSION["UserSalary"] = $row["s_name"]." ( ".$row["s_money"]." )";
        $_SESSION["timeout"] = time();

        // เช็ค Admin User
        if($_SESSION["UserLevel"]=="admin") {
            header("location: index.php");
        }
        if($_SESSION["UserLevel"]=="user") {
            header("location: index.php");
        }
    } else {
        echo "<script>
        alert('User หรือ Password ไม่ถูกต้อง');
        window.location.replace('login.php');
        </script>";
    }
} else {
    header("location: login.php");
}
?>