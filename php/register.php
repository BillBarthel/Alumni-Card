<?php
$cookieName = "loggedIn";

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

$sql = "INSERT INTO registered_alumni (AlumnusID, Email, Password) VALUES ('', '$email', '$cryptPass')";

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
    header('Location: alumnicard.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

/*
$conn = new mysqli($servername, $username, $dbpassword);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO '$database' ('id', 'email', 'password') VALUES ('', '$email', '$cryptPass')";

//Check for duplicate data and various other things

if ($conn->query($sql) === TRUE) {
    header('Location: ../yourcard.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error . "<br>" . $cryptPass;
}

$conn->close();
?>

INSERT INTO UWOAlumniCardUsers (id, email, password) VALUES ('', 'bill', 'pass');
*/