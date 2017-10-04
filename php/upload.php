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
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
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
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	echo "<br>";
	echo $_FILES["fileToUpload"]["name"] . "<br>";
	$filename=$_FILES["fileToUpload"]["name"];
	$temp = explode(".", $filename);
	$extension=end($temp);
	$newfilename=$_SESSION["username"] .".".$extension;

    $email = $_SESSION['email'];
    $servername = "localhost";
    $database = "alumni_card";
    $username = "root";
    $dbpassword = "";
    $conn = mysqli_connect($servername, $username, $dbpassword, $database);
    $sql = "UPDATE registered_alumni SET AlumnPhoto ='$newfilename' WHERE Email = '$email'";

    if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>