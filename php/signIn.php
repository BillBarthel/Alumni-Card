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

$conn->close();

/*

$sql = "INSERT INTO RegisteredAlumni (AlumnusID, email, password) VALUES ('', '$email', '$cryptPass')";

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
    header('Location: ../alumnicard.html');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

/*
$cookieName = "loggedIn";

$VOLUNTEER = "volunteer";
$VOLUNTEER_LEADER = "volunteerLeader";
$ADMIN = "admin";
$SALT = "z978nfNMzx83bvb2xDv74G4";

$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);

if(isset($_POST["register"]))
{
	header('Location: register.html');
}
else
{
	$db = new PDO("mysql:dbname=id2980768_alumnicard;host=localhost","id2980768_admin","Remember12");
	$user_info = $db->query("SELECT `email`, `password` FROM `UWO Alumni Card Users` WHERE email='$email'")->fetchAll();

	foreach($user_info as $user)
	{
		$db_email = $user["email"];
		$db_password = $user["password"];
		//$accountType = $user["accountType"];
	}

	if(isset($db_email) && $db_email === $email && crypt($password, $SALT) === $db_password)
	{
		header('Location: yourcard.html');
//		$cookieValue = $email;
//		setcookie($cookieName, $cookieValue);
//		if(strcmp($accountType, $VOLUNTEER) === 0)
//			header('Location: volunteerProfile.php');
//		else if(strcmp($accountType, $VOLUNTEER_LEADER) === 0)
//			header('Location: volunteerLeaderProfile.php');
//		else if(strcmp($accountType, $ADMIN) === 0)
//			header('Location: administratorProfile.php');
	}
	else
	{
		echo "Invalid email or password<br>";
		//echo '<a href="http://webdev.cs.uwosh.edu/students/barthw52/WinneconneThriftAndGift/register.html">Register</a>' . " ";
		//echo '<a href="http://webdev.cs.uwosh.edu/students/barthw52/WinneconneThriftAndGift/signIn.html">Back</a>';
	}
}*/
?>