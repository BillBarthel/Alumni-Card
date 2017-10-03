<?php
session_start();
$backgroundImage = $_SESSION["background"];
if($backgroundImage == 1)
  $img = "ClashAlumniCardTemplate.jpg";
else if($backgroundImage == 2)
  $img = "COBAlumniCardTemplate.jpg";
else
  $img = "ScapeAlumniCardTemplate.jpg";

$alumnphoto = $_SESSION['alumnphoto']
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alumni Titan card</title>
	<link rel="stylesheet" type="text/css" href="../css/alumnicard.css">
	<noscript><p>This page requires javaScript to run correctly!</p></noscript>
</head>
<body>

<?php if($backgroundImage == 1)://clash ?>
<div class="clashbackground">
	<div class="clash-center-left">
		<img src="../Images/Uploads/<?php echo $alumnphoto; ?>" height="175px" width="150"/>
	</div>
</div>

<?php elseif($backgroundImage == 2)://COB ?>
<div class="cobbackground">
	<div class="cob-center-left">
		<img src="../Images/Uploads/<?php echo $alumnphoto; ?>" height="175px" width="150"/>
	</div>
</div>

<?php else://Scape ?>
<div class="scapebackground">
	<div class="scape-center-left">
		<img src="../Images/Uploads/<?php echo $alumnphoto; ?>" height="175px" width="150"/>
	</div>
</div>

<?php endif; ?>


<br>
<br>
<br>
<br>
<br>
<div class="container">
  <img src="../Images/TitanCardBackgrounds/<?php echo $img; ?>" height="400px" width="600"/>  
  <div class="bottom-left">
	<table style="width:100%">
  		<tr>
   		 	<td><?php echo $_SESSION["firstname"]; ?>
    		<?php echo $_SESSION["lastname"]; ?>
   			<?php echo "'" . substr($_SESSION["graduationyear"], -2); ?></td>
  		</tr>
  		<tr>
    		<td><?php echo $_SESSION["collegeattended"]; ?></td>
  		</tr>
	</table>
  </div>
</div>

<br>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<img src="../Images/Uploads/<?php echo $alumnphoto; ?>" height="175px" width="150"/>

</body>
</html>