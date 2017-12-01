<?php
session_start();
if(!isset($_SESSION["email"]))
    header("Location: ../index.html");

$target_dir = "../Images/Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['photoerror'] = "Please choose a valid photo.";
        header("Location: alumnicard.php");
        exit();
    }
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
    	$_SESSION['photoerror'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	header("Location: alumnicard.php");
        exit();
	}
	
	$filename = $_FILES["fileToUpload"]["name"];
	$temp = explode(".", $filename);
	$extension = end($temp);
	$userID = (int)$_SESSION["alumnusid"];
	$newfilename = $userID .".".$extension;
	
    $email = $_SESSION['email'];
    $servername = "localhost";
    $database = "u708549243_uwoac";
    $username = "u708549243_admin";
    $dbpassword = "S5mKwWvjJay9";
    $conn = mysqli_connect($servername, $username, $dbpassword, $database);
    $sql = "UPDATE registered_alumni SET AlumnPhoto = '$newfilename' WHERE Email = '$email'";
    if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                                                        	$target_dir . $newfilename)) {
    	//Update the session variable
    	$_SESSION["alumnphoto"] = $newfilename;
    	$_SESSION['photoerror'] = "";
    } else {
    	$_SESSION['photoerror'] = "Sorry, there was an error uploading your file.";
    }
    header("Location: alumnicard.php");
    mysqli_close($con);
	
} elseif (isset($_POST["removephoto"])) {
	$servername = "localhost";
	$database = "u708549243_uwoac";
	$username = "u708549243_admin";
	$dbpassword = "S5mKwWvjJay9";
	
	$con = mysqli_connect($servername, $username, $dbpassword, $database);
	if(!$con){
		die("Connection failed : " . mysqli_connect_error());
	}
	
	$alumnusid = (int)$_SESSION["alumnusid"];
	$default = "default.jpg";
	
	//update database
	$sql = "UPDATE registered_alumni SET AlumnPhoto='$default' WHERE AlumnusID = '$alumnusid'";
	if (mysqli_query($con, $sql)){
		//Update the session variable
		$_SESSION["alumnphoto"] = $default;
		$_SESSION['photoerror'] = "";
	}else{
		$_SESSION['photoerror'] = "Photo could not be removed at this time";
	}
	header("Location: alumnicard.php");
	mysqli_close($con);
}
?>