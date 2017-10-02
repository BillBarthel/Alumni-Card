<?php
session_start();

$email = $_SESSION['email'];
$backgroundImage = $_SESSION['background'] = $_POST["background"];

$servername = "localhost";
$database = "alumni_card";
$username = "root";
$dbpassword = "";
$conn = mysqli_connect($servername, $username, $dbpassword, $database);

if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
} else {
	//Change alumni card background if different from default
	echo $backgroundImage;
	echo $email;
	if($backgroundImage != 1){
		$sql = "UPDATE registered_alumni SET BackgroundImage='$backgroundImage' WHERE Email = '$email'";
		$conn->query($sql);
	}

	header("Location: alumnicard.php");
}

?>