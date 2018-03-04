<?php
$firstName = htmlspecialchars($_GET["firstName"], ENT_QUOTES);
$lastName = htmlspecialchars($_GET["lastName"], ENT_QUOTES);
$graduationName = htmlspecialchars($_GET["graduationName"], ENT_QUOTES);
$collegeAttended = htmlspecialchars($_GET["collegeAttended"], ENT_QUOTES);
$graduationYear = htmlspecialchars($_GET["graduationYear"], ENT_QUOTES);
$email = htmlspecialchars($_GET["email"], ENT_QUOTES);
$mailingAddress = htmlspecialchars($_GET["mailingAddress"], ENT_QUOTES);
$city = htmlspecialchars($_GET["city"], ENT_QUOTES);
$state = htmlspecialchars($_GET["state"], ENT_QUOTES);
$zipCode = htmlspecialchars($_GET["zipCode"], ENT_QUOTES);
$phoneNumber = htmlspecialchars($_GET["phoneNumber"], ENT_QUOTES);

$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";

$conn = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$conn){
	die("Connection failed : " . mysqli_connect_error());
}

//Verifies that the tail of the submitted email is an
//UWO alumni email
$checkEmail = explode("@", $email);

if(trim($firstName) == false ||
   trim($lastName) == false ||
   trim($email) == false){
		echo "firstName." . $firstName . " " ."lastName." . $lastName . " " ."email." . $email;
}else if(sizeof($checkEmail) != 2){
	echo "Invalid email address,";
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
		$nameatgraduation = strtoupper($graduationName);
		$collegeAttended = strtoupper($collegeAttended);

		$sql = "INSERT INTO registered_alumni (AlumnusID, Email, 
							FirstName, LastName, NameAtGraduation, CollegeAttended, GraduationYear, MailingAddress, City, State, ZipCode, PhoneNumber) 
							VALUES ('', '$email', '$firstName',
							'$lastName','$nameatgraduation', '$collegeAttended', '$graduationYear', '$mailingAddress', '$city', '$state', '$zipCode', '$phoneNumber')";

		if (mysqli_query($conn, $sql)) {
			//Get newly registered AlumnusID to display on alumnicard.php
			$sql = "SELECT AlumnusID FROM registered_alumni WHERE Email = '$email'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			//initialize session variables
			$id = $row["AlumnusID"];
			$idLength = strlen(strval($id));
			$numPaddedZeros = 7 - $idLength;
			$paddedId = "";
			for ($i=0; $i <$numPaddedZeros ; $i++) { 
			$paddedId = $paddedId . "0";
			}
			$paddedId .= strval($id);
			$username = $checkEmail[0];
			//$qrcode = $row["QRCode"];
			
			//Code to send out an email after a new user registers
			/*
			$headers = 'From: admin@uwoalumnicard.xyz' . "\r\n";
			$emailMsg = " First Name: " . $firstName . "\n Last Name: " . $lastName .
						"\n Name at Graduation (If Different): " . $nameatgraduation .
						"\n Email: " . $email . "\n College Attended: " . $collegeAttended .
						"\n Graduation Year: " . $graduationYear . 
						"\n Mailing Address: " . $mailingAddress . "\n City: " . $city .
						"\n State/Province: " . $state . "\n Zip Code: " . $zipCode .
						"\n Cell Phone Number: " . $phoneNumber;

			mail("barthw52@uwosh.edu", "Alumni Titan Card Registration", $emailMsg);
			*/
			
			$myObj->firstname = $firstName;
		    $myObj->lastname = $lastName;
		    $myObj->collegeattended = $collegeAttended;
			$myObj->paddedId = $paddedId;
		    $myObj->email = $email;
		    $myObj->username = $checkEmail[0];
		    $myObj->graduationyear = $graduationYear;
		    //$myObj->qrcode = $row["QRCode"];
		    $myObj->alumnphoto = "default.jpg";
		    $myObj->background = 1;

		    $myJSON = json_encode($myObj);

		    echo $myJSON;
		    
		} else {
			echo "Somthing went wrong. Cannot register at this time.";
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		echo "Email already registered.";
	}
}

mysqli_close($conn);

?>