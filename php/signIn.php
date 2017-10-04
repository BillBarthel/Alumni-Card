<?php
session_start();

$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);

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
	$dbpassword = $row["Password"];
	$id = $row["AlumnusID"];
	$idLength = strlen(strval($id));
	$numPaddedZeros = 7 - $idLength;
	for ($i=0; $i <$numPaddedZeros ; $i++) { 
		$paddedId = $paddedId . "0";
	}
	$paddedId .= strval($id);
	$_SESSION["alumnusid"] = $paddedId;
	$_SESSION['email'] = $email;
	$checkEmail = explode("@", $email);
	$_SESSION["username"] = $checkEmail[0];
	$_SESSION["firstname"] = $row["FirstName"];
	$_SESSION["lastname"] = $row["LastName"];
	$_SESSION["collegeattended"] = $row["CollegeAttended"];
	$_SESSION["graduationyear"] = $row["GraduationYear"];
	//$_SESSION['qrcode'] = $row["QRCode"];
	$_SESSION['alumnphoto'] = $row["AlumnPhoto"];
	$_SESSION['background'] = $row["BackgroundImage"];
}
else
{
	echo "Invalid username or password.";
	die();
}

if(crypt($password, $SALT) === $dbpassword)
{
	header("Location: alumnicard.php");
}
else
{
	echo "Invalid username or password.";
	die();
}

mysqli_close($conn);
?>