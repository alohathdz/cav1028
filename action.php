<?php
$connect=mysqli_connect("localhost","root","01545","cav1028");
$input = filter_input_array(INPUT_POST);
$firstname=mysqli_real_escape_string($connect,$input['e_firstname']);
$lastname=mysqli_real_escape_string($connect,$input['e_lastname']);

if($input["action"]=='edit'){
  $query="UPDATE employee SET e_firstname='".$firstname."' , e_lastname='".$lastname."' WHERE eid='".$input['eid']."'";
  mysqli_query($connect,$query);
}

if($input["action"]=='delete'){
  $query="DELETE from cav1028 WHERE eid='".$input['eid']."'";
  mysqli_query($connect,$query);
}

mysqli_close($connect);
echo json_encode($input);
?>
