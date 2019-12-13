<?php

$con = mysqli_connect("localhost", "root", "01545", "cav1028");

if (!$con) {
	die("Failed to connect to database" . mysqli_error($con));
}

?>