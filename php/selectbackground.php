<?php
session_start();
if(!isset($_SESSION["email"]))
    header("Location: ../index.html");

$email = $_SESSION['email'];
$backgroundImage = $_SESSION['background'] = $_POST["background"];

$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";
$conn = mysqli_connect($servername, $username, $dbpassword, $database);

if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
} else {
	//Change alumni card background if different from default
	if($backgroundImage != 1){
		$sql = "UPDATE registered_alumni SET BackgroundImage='$backgroundImage' WHERE Email = '$email'";
		$conn->query($sql);
	}

	header("Location: alumnicard.php");
}

?>