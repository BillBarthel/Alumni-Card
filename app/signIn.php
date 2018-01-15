<?php
$email = htmlspecialchars($_GET["email"], ENT_QUOTES);

$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";

$conn = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
}

$sql = "SELECT * FROM registered_alumni WHERE Email = '$email'";
$result = $conn->query($sql);

if($result->num_rows == 0){
	echo ".".$email.".";
}else{
	$row = $result->fetch_assoc();
	$id = $row["AlumnusID"];
	$idLength = strlen(strval($id));
	$numPaddedZeros = 7 - $idLength;
	$paddedId = "";
	for ($i=0; $i <$numPaddedZeros ; $i++) { 
		$paddedId = $paddedId . "0";
	}
	$paddedId .= strval($id);
	$myObj->paddedId = $paddedId;
	$myObj->email = $email;
	$checkEmail = explode("@", $email);
	$myObj->username = $checkEmail[0];
	$myObj->firstname = $row["FirstName"];
	$myObj->lastname = $row["LastName"];
	$myObj->collegeattended = $row["CollegeAttended"];
	$myObj->graduationyear = $row["GraduationYear"];
	//$myObj->qrcode = $row["QRCode"];
	$myObj->alumnphoto = $row["AlumnPhoto"];
	$myObj->background = $row["BackgroundImage"];

	$myJSON = json_encode($myObj);

	echo $myJSON;
}

mysqli_close($conn);
?>