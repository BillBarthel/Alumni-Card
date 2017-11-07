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
        echo "File is not an image.";
        $uploadOk = 0;
    }

	// Check if file already exists
	//Probably delete this.
	//With username as the photo name every
	//photo name will be unique
	if (file_exists($target_file)) {
    	echo "Sorry, file already exists.";
    	$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    	echo "Sorry, your file is too large.";
    	$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	header("Location: alumnicard.php");
	// if everything is ok, try to upload file
	} else {
		$filename = $_FILES["fileToUpload"]["name"];
		$temp = explode(".", $filename);
		$extension = end($temp);
		$userID = (int)$_SESSION["alumnusid"];
		$newfilename = $userID .".".$extension;
	
    	$email = $_SESSION['email'];
    	$servername = "localhost";
    	$database = "id2980768_alumnicard";
    	$username = "id2980768_admin";
    	$dbpassword = "Remember12";
    	$conn = mysqli_connect($servername, $username, $dbpassword, $database);
    	$sql = "UPDATE registered_alumni SET AlumnPhoto = '$newfilename' WHERE Email = '$email'";
    	if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                                                        	$target_dir . $newfilename)) {
    		//Update the session variable
        	$_SESSION["alumnphoto"] = $newfilename;
        	header("Location: alumnicard.php");
    	} else {
        	echo "Sorry, there was an error uploading your file.";
    	}
    	mysqli_close($con);
	}
} elseif (isset($_POST["removephoto"])) {
	$servername = "localhost";
	$database = "id2980768_alumnicard";
	$username = "id2980768_admin";
	$dbpassword = "Remember12";
	
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
		header("Location: alumnicard.php");
	}else{
		echo "Photo could not be removed at this time";
	}
	mysqli_close($con);
}
?>