<?php
session_start();
//double check credentials
//May look more elegant if put into an array
$firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES);
$lastName = htmlspecialchars($_POST["lastName"], ENT_QUOTES);
$nameatgraduation = htmlspecialchars($_POST["nameatgraduation"], ENT_QUOTES);
$collegeAttended = htmlspecialchars($_POST["collegeAttended"], ENT_QUOTES);
$graduationYear = htmlspecialchars($_POST["graduationYear"], ENT_QUOTES);
$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
$mailingAddress = htmlspecialchars($_POST["mailingAddress"], ENT_QUOTES);
$city = htmlspecialchars($_POST["city"], ENT_QUOTES);
$state = htmlspecialchars($_POST["state"], ENT_QUOTES);
$zipCode = htmlspecialchars($_POST["zipCode"], ENT_QUOTES);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES);

$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";
$conn = mysqli_connect($servername, $username, $dbpassword, $database);

//Verifies that the tail of the submitted email is an
//UWO alumni email
$checkEmail = explode("@", $email);

if(trim($firstName) == false ||
   trim($lastName) == false ||
   trim($email) == false){
		echo "All required fields are not filled.";
}else if(sizeof($checkEmail) != 2){
	echo "Invalid email address,";
}  else {//Insert user into database
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
		$nameatgraduation = strtoupper($nameatgraduation);
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
			for ($i=0; $i <$numPaddedZeros ; $i++) { 
				$paddedId = $paddedId . "0";
			}
			$paddedId .= strval($id);
			$_SESSION["alumnusid"] = $paddedId;
			$_SESSION["username"] = $checkEmail[0];
			$_SESSION['email'] = $email;
			$_SESSION["firstname"] = $firstName;
			$_SESSION["lastname"] = $lastName;
			$_SESSION["collegeattended"] = $collegeAttended;
			$_SESSION["graduationyear"] = $graduationYear;
			$_SESSION['alumnphoto'] = "default.jpg";
/*		
            //Can't send emails through current, free webhoster. Mail() returns true;
            
            $headers = 'From: webmaster@example.com' . "\r\n" .
                       'Reply-To: webmaster@example.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

			$emailMsg = "First Name: " . $firstName . "\n Last Name: " . $lastName .
						"\n Name at Graduation (If Different): " . $nameatgraduation .
						"\n Email: " . $email . "\n College Attended: " . $collegeAttended .
						"\n Graduation Year: " . $graduationYear . 
						"\n Mailing Address: " . $mailingAddress . "\n City: " . $city .
						"\n State/Province: " . $state . "\n Zip Code: " . $zipCode .
						"\n Cell Phone Number: " . $phoneNumber;

			mail("to.email.com", "Alumni Titan Card Registration", $emailMsg);
*/

			//header("Location: ../selectbackground.html");
			echo "success";
		} else {
			echo "Somthing went wrong. Cannot register at this time.";
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		//Does this give away too much information?
		header("Location: ../index.html");
		echo "Email already registered.";
	}
}

mysqli_close($conn);

?>