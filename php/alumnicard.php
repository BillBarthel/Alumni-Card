<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alumni Titan card</title>
	<link rel="stylesheet" type="text/css" href="../css/alumnicard.css">
	<noscript><p>This page requires javaScript to run correctly!</p></noscript>
</head>
<body>

<?php

$backgroundImage = $_SESSION["background"];
if($backgroundImage == 1)
	$img = "ClashAlumniCardTemplate.jpg";
else if($backgroundImage == 2)
	$img = "COBAlumniCardTemplate.jpg";
else
	$img = "ScapeAlumniCardTemplate.jpg";
?>

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

</body>
</html>