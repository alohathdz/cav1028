<?php
$servername = "localhost";
$username = "root";
$password = "01545";
$conn = mysqli_connect($servername, $username, $password,"cav1028");

$output='';

$sql="select * from employee where e_firstname LIKE '%".$_POST['search']."%' order by e_rank";
$result = mysqli_query($conn,$sql);
$output.="<h4 align='center'>Search Result</h4>";
if(mysqli_num_rows($result)>0){
$output.="<table class='table table-bordered'>
      <tr>
        <th>ชื่อ</th>
        <th>สกุล</th>
        <th>หมายเลข 13 หลัก</th>
        <th>หมายเลข 10 หลัก</th>
      </tr>";
while($row = mysqli_fetch_array($result)) {
          $output.="<tr><td>".$row["e_firstname"]."</td><td>".$row["e_lastname"]."</td><td>".$row["eid"]."</td><td>".$row["e_idarmy"]."</td></tr>";
}
  $output.="</table>";
  echo $output;
}else{
  echo "Data Not Found";
}
?>
