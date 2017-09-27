<?php
//$cookieName = "loggedIn";
//double check credentials
//May look more elegant if put into an array
$firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES);
$lastName = htmlspecialchars($_POST["lastName"], ENT_QUOTES);
$collegeAttended = htmlspecialchars($_POST["collegeAttended"], ENT_QUOTES);
$graduationYear = htmlspecialchars($_POST["graduationYear"], ENT_QUOTES);
$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);
$passwordConfirmed = htmlspecialchars($_POST["confirmPassword"], ENT_QUOTES);

$SALT = "z978nfNMzx83bvb2xDv74G4";
$VALID_EMAIL = "alumni.uwosh.edu";

$servername = "localhost";
$database = "alumni_card";
$username = "root";
$dbpassword = "";
$conn = mysqli_connect($servername, $username, $dbpassword, $database);
$cryptPass = crypt($password, $SALT);

//Verifies that the tail of the submitted email is an
//UWO alumni email
$checkEmail = explode("@", $email);

if(trim($firstName) == false ||
   trim($lastName) == false ||
   trim($email) == false ||
   trim($password) == false ||
   trim($passwordConfirmed) == false){
		echo "All fields are not filled.";
}else if(sizeof($checkEmail) != 2 || strcasecmp($checkEmail[1], $VALID_EMAIL) != 0){
	echo "Invalid email address,";
} else if(strcmp($password, $passwordConfirmed) != 0){
	echo "Passwords do no match.";
} else {//Insert user into database
	if(!$conn){
		die("Connection failed : " . mysqli_connect_error());
	}

	$sql = "SELECT Email FROM registered_alumni WHERE Email = '$email'";
	$result = $conn->query($sql);

	//email not registered
	if($result->num_rows == 0){
		//Convert inputs to uppercase
		$firstName = strtoupper($firstName);
		$lastName = strtoupper($lastName);
		$collegeAttended = strtoupper($collegeAttended);

		$sql = "INSERT INTO registered_alumni (AlumnusID, Email, Password, FirstName, LastName, CollegeAttended, GraduationYear) VALUES ('', '$email', '$cryptPass', '$firstName', '$lastName', '$collegeAttended', '$graduationYear')";

		if (mysqli_query($conn, $sql)) {
			//Get newly registered AlumnusID to display on alumnicard.php
			$sql = "SELECT AlumnusID, BackgroundImage FROM registered_alumni WHERE Email = '$email'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$alumnusID = $row["AlumnusID"];
			$backgroundImage = $row["BackgroundImage"];

    		//Transfer data differently. This is really poor.
			header("Location: alumnicard.php?alumnusID=$alumnusID&firstName=$firstName&lastName=$lastName&collegeAttended=$collegeAttended&graduationYear=$graduationYear&qrCode=$qrCode&alumnPhoto=$alumnPhoto&backgroundImage=$backgroundImage");
		} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		//Does this give away too much information?
		echo "Email already registered.";
	}
}

mysqli_close($conn);