<?php

$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);
//$passwordConfirmed = htmlspecialchars($_POST["passwordConfirmed"], ENT_QUOTES);

$SALT = "z978nfNMzx83bvb2xDv74G4";

$servername = "localhost";
$database = "alumni_card";
$username = "root";
$dbpassword = "";
$cryptPass = crypt($password, $SALT);

$conn = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
}

$sql = "SELECT * FROM registered_alumni WHERE Email = '$email'";
$result = $conn->query($sql);

if($result->num_rows != 0)
{
	$row = $result->fetch_assoc();
	$alumnusID = $row["AlumnusID"];
	$dbpassword = $row["Password"];
	$firstName = $row["FirstName"];
	$lastName = $row["LastName"];
	$collegeAttended = $row["CollegeAttended"];
	$graduationYear = $row["GraduationYear"];
	$qrCode = $row["QRCode"];
	$alumnPhoto = $row["AlumnPhoto"];
	$backgroundImage = $row["BackgroundImage"];
}
else
{
	echo "Invalid username or password.";
	die();
}

if(crypt($password, $SALT) === $dbpassword)
{
	//Transfer data differently. This is really poor.
	header("Location: alumnicard.php?alumnusID=$alumnusID&firstName=$firstName&lastName=$lastName&collegeAttended=$collegeAttended&graduationYear=$graduationYear&qrCode=$qrCode&alumnPhoto=$alumnPhoto&backgroundImage=$backgroundImage");
}
else
{
	echo "Invalid username or password.";
	die();
}

mysqli_close($conn);
?>