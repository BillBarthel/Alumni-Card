<!DOCTYPE html>
<html>
<head>
	<title>Alumni Titan card</title>
	<link rel="stylesheet" type="text/css" href="../css/alumnicard.css">
	<noscript><p>This page requires javaScript to run correctly!</p></noscript>
</head>
<body>

<?php
$backgroundImage = $_GET["backgroundImage"];
if($backgroundImage == 0)
	$img = "COBAlumniCardTemplate.jpg";
else if($backgroundImage == 1)
	$img = "ClashAlumniCardTemplate.jpg";
else
	$img = "ScapeAlumniCardTemplate.jpg";
?>

<div class="container">
  <img src="../Images/TitanCardBackgrounds/<?php echo $img; ?>" height="400px" width="600"/>
  <div class="bottom-left">
	<table style="width:100%">
  		<tr>
   		 	<td><?php echo htmlspecialchars($_GET["firstName"]); ?>
    		<?php echo htmlspecialchars($_GET["lastName"]); ?>
   			<?php echo "'" . substr($_GET["graduationYear"], -2); ?></td>
  		</tr>
  		<tr>
    		<td><?php echo htmlspecialchars($_GET["collegeAttended"]); ?></td>
  		</tr>
	</table>
  </div>
</div>

</body>
</html>