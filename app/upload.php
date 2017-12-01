<?php
//importing dbDetails file 
$servername = "localhost";
$database = "u708549243_uwoac";
$username = "u708549243_admin";
$dbpassword = "S5mKwWvjJay9";

$con = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$con){
	die("Connection failed : " . mysqli_connect_error());
}
 
//this is our upload folder 
$upload_path = '../Images/Uploads/';
 
//Getting the server ip 
$server_ip = gethostbyname(gethostname());
 
//creating the upload url http://192.168.0.7/AlumniCardAndroid/signIn.php
$upload_url = "http://".$server_ip.$upload_path;
//$upload_url = 'http://'.$server_ip.'/AlumniCardAndroid/'.$upload_path; 
 
//response array 
$response = array(); 
  
if($_SERVER['REQUEST_METHOD']=='POST'){
 
//checking the required parameters from the request 
if(isset($_POST['name']) and isset($_FILES['image']['name'])){
 
//connecting to the database 
//$con = mysqli_connect($HOST,$USER,$PASS,$DB) or die('Unable to Connect...');
 
//getting name from the request 
$name = $_POST['name'];
 
//getting file info from the request 
$fileinfo = pathinfo($_FILES['image']['name']);

//getting the file extension 
$extension = $fileinfo['extension'];
 
//file url to store in the database 
$file_url = $upload_url . $name . '.' . $extension;
 
//file path to upload in the server 
$file_path = $upload_path . $name . '.'. $extension; 
$photo = $name.".".$extension;
 
//trying to save the file in the directory 
try{
	//add photo to appropriate folder
	move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
	//update database
	$sql = "UPDATE registered_alumni SET AlumnPhoto='$photo' WHERE AlumnusID = '$name'";
 
	//adding the path and name to database 
	if(mysqli_query($con,$sql)){
 
		//filling response array with values 
		$response['error'] = false; 
		$response['url'] = $file_url; 
		$response['name'] = $name;
	}
 	//if some error occurred 
 	}catch(Exception $e){
 		$response['error']=true;
 		$response['message']=$e->getMessage();
 	} 
 	//displaying the response 
 	echo json_encode($response);
 
 	//closing the connection 
 	mysqli_close($con);
 	}else{
 		$response['error']=true;
 		$response['message']='Please choose a file';
 	}
}

?>