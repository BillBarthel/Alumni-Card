<?php
$email = $_GET["email"];
$backgroundImage = $_GET["background"];

$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";

//Connects to the database to save the user's titan alumni card background
$conn = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
} else {
	$sql = "UPDATE registered_alumni SET BackgroundImage='$backgroundImage' WHERE Email = '$email'";
	$conn->query($sql);

	echo "success";
}
?>