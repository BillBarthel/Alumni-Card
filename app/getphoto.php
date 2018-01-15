<?php
//Retrive the user's personal photo to be displayed in the app
$servername = "localhost";
$database = "id2980768_alumnicard";
$username = "id2980768_admin";
$dbpassword = "Remember12";

$con = mysqli_connect($servername, $username, $dbpassword, $database);
if(!$con){
	die("Connection failed : " . mysqli_connect_error());
}
 
 $name = $_POST['name'];
 //sql query to fetch all images 
 $sql = "SELECT AlumnPhoto FROM registered_alumni WHERE AlumnusID = '$name'";
 
 //getting images 
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);
 $imgname = $row["AlumnPhoto"];

 if($imgname === NULL){
 	echo "false";
 }else{
 	echo $imgname;
 }
 
 //response array 
 $response = array(); 
 $response['error'] = false; 
 $response['images'] = array(); 
 
 //traversing through all the rows 
 while($row = mysqli_fetch_array($result)){
 $temp = array(); 
 $temp['id']=$row['id'];
 $temp['name']=$row['name'];
 $temp['url']=$row['url'];
 array_push($response['images'],$temp);
 }
 //displaying the response 
 echo json_encode($response);
 ?>