<?php
//importing dbDetails file 
$servername = "localhost";
$database = "u708549243_uwoac";
$username = "u708549243_admin";
$dbpassword = "S5mKwWvjJay9";

$alumnusid = $_GET["alumnusid"];
$default = "default.jpg";

$con = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$con){
	die("Connection failed : " . mysqli_connect_error());
}else {
	$sql = "UPDATE registered_alumni SET AlumnPhoto='$default' WHERE AlumnusID = '$alumnusid'";
	$con->query($sql);

	echo "success";
}


mysqli_close($con);
?>