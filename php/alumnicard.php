<!DOCTYPE html>
<html>
<head>
	<title>Alumni Titan card</title>
</head>
<body>

<?php
$backgroundImage = $_GET["backgroundImage"];
if($backgroundImage == 0)
	echo "<img src=\"../TitanCardBackgrounds/COBAlumniCard.jpg\" alt=\"COBAlumniCard.jpg\" height=\"360px\" width=\"577\"><br>";
else if($backgroundImage == 1)
	echo "<img src=\"../TitanCardBackgrounds/ClashAlumniCard.jpg\" alt=\"ClashAlumniCard.jpg\" height=\"360px\" width=\"577\"><br>";
else
	echo "<img src=\"../TitanCardBackgrounds/ScapeAlumniCard.jpg\" alt=\"ScapeAlumniCard.jpg\" height=\"360px\" width=\"577\"><br>";
?>
<?php
echo htmlspecialchars($_GET["alumnusID"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["firstName"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["lastName"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["collegeAttended"]);
?>
<br>
<?php
echo htmlspecialchars($_GET["graduationYear"]);
?>
<br>
<?php
if(!htmlspecialchars($_GET["alumnPhoto"])){
	echo "QR code not yet generated";
} else {
	echo "Generated QR code should display here";
}
?>
<br>
<?php
if(!htmlspecialchars($_GET["alumnPhoto"])){
	echo "Personal photo not yet uploaded";
} else {
	echo "Uploaded personal photo should display here";
}
?>
</body>
</html>