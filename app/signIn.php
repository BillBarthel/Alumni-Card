<?php
$email = htmlspecialchars($_GET["email"], ENT_QUOTES);

$servername = "localhost";
$database = "u708549243_uwoac";
$username = "u708549243_admin";
$dbpassword = "S5mKwWvjJay9";

$conn = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
}

$sql = "SELECT * FROM registered_alumni WHERE Email = '$email'";
$result = $conn->query($sql);

if($result->num_rows == 0){
	echo ".".$email.".";//echo "invalid email.";
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
		$checkEmail = explode("@", $email);
		$username = $checkEmail[0];
		$firstname = $row["FirstName"];
		$lastname = $row["LastName"];
		$collegeattended = $row["CollegeAttended"];
		$graduationyear = $row["GraduationYear"];
		//$qrcode = $row["QRCode"];
		$alumnphoto = $row["AlumnPhoto"];
		$background = $row["BackgroundImage"];
		echo "success-".$paddedId.",".$email.",".$username.",".$firstname.",".$lastname.",".$collegeattended.",".$graduationyear.",".$alumnphoto.",".$background;
	
}

mysqli_close($conn);
?>