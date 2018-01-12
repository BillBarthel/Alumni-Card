<?php
//importing dbDetails file 
$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";

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